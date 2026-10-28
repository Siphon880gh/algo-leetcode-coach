<?php
/**
 * Two problem tools for Mini games, Algo Guides, and Step-by-step:
 *
 * - "Problems with most interviews" (gallery pages: games/index.php, guides/index.php?kind=algo,
 *   coaching/index.php): the "Or problems most companies ask" link under Find a company in the Filter's
 *   Companies flyout opens a right slide-in panel listing every
 *   problem that has a page of that type, sorted by how many companies tag it (most first).
 *   Problems with no company are left out. Rows come from api/problems-by-company.php.
 * - "Check understanding" (detail pages): a button on the problem panel that opens a prompt builder. The prompt
 *   carries the problem statement and asks ChatGPT or Claude to interview you about the ask.
 *
 * Tests: php scripts/problem-tools/test-problem-tools.php
 */

declare(strict_types=1);

require_once __DIR__ . '/problem.php';

/**
 * Page types that get the tools: list type => [detail route, panel label].
 *
 * @return array<string, array{route: string, label: string}>
 */
function problem_panel_types(): array
{
    return [
        'games' => ['route' => 'games/play.php?id=', 'label' => 'Mini games'],
        'guides' => ['route' => 'guides/view.php?id=', 'label' => 'Algo Guides'],
        'coaching' => ['route' => 'coaching/session.php?id=', 'label' => 'Step-by-step'],
    ];
}

/**
 * Problems sorted by distinct company count (desc), then problem number (asc).
 * Pages without a LeetCode number, and problems no company tags, are left out.
 * One row per problem number; when two pages share a number the first slug wins.
 *
 * @param list<array{slug: string, meta: array<string, mixed>}> $items
 * @param array<int, list<string>> $slugsByProblem
 * @return list<array{n: int, slug: string, title: string, difficulty: string, companies: int}>
 */
function problem_rows_by_company_count(array $items, array $slugsByProblem): array
{
    usort($items, static function (array $a, array $b): int {
        return strcmp((string) $a['slug'], (string) $b['slug']);
    });
    $rows = [];
    foreach ($items as $item) {
        $meta = is_array($item['meta'] ?? null) ? $item['meta'] : [];
        $n = content_leetcode_number($meta);
        if ($n === null || isset($rows[$n])) {
            continue;
        }
        $count = count(array_unique($slugsByProblem[$n] ?? []));
        if ($count < 1) {
            continue;
        }
        $difficulty = content_leetcode_difficulty_for_meta($meta) ?? '';
        $rows[$n] = [
            'n' => $n,
            'slug' => (string) $item['slug'],
            'title' => trim((string) ($meta['title'] ?? $item['slug'])),
            'difficulty' => $difficulty,
            'companies' => $count,
        ];
    }
    $rows = array_values($rows);
    usort($rows, static function (array $a, array $b): int {
        return [$b['companies'], $a['n']] <=> [$a['companies'], $b['n']];
    });
    return $rows;
}

/**
 * Pages of a type that the visitor can open (locked premium pages are already hidden).
 *
 * @return list<array{slug: string, meta: array<string, mixed>}>
 */
function problem_panel_items(string $type): array
{
    if ($type === 'guides') {
        return list_guides('algo');
    }
    return isset(problem_panel_types()[$type]) ? list_content($type) : [];
}

/**
 * Rows for the slide-in panel, with the detail URL of the same page type.
 *
 * @return list<array{n: int, slug: string, title: string, difficulty: string, companies: int, url: string}>
 */
function problem_panel_rows(string $type): array
{
    $types = problem_panel_types();
    if (!isset($types[$type])) {
        return [];
    }
    $rows = problem_rows_by_company_count(problem_panel_items($type), content_leetcode_company_slugs_by_problem());
    foreach ($rows as $i => $row) {
        $rows[$i]['url'] = url($types[$type]['route'] . rawurlencode($row['slug']));
    }
    return $rows;
}

/**
 * Prompt that asks ChatGPT or Claude to interview you on what a problem is asking.
 *
 * @param array{n: int, title: string, difficulty?: string, url?: string, statement?: string, statement_kind?: string} $p
 */
function problem_check_understanding_prompt(array $p): string
{
    $n = (int) $p['n'];
    $title = trim((string) ($p['title'] ?? ''));
    $difficulty = trim((string) ($p['difficulty'] ?? ''));
    $link = trim((string) ($p['url'] ?? ''));
    $statement = trim((string) ($p['statement'] ?? ''));
    $kind = (string) ($p['statement_kind'] ?? ($statement !== '' ? 'full' : 'none'));
    $diffLabel = ['Med' => 'Medium'][$difficulty] ?? $difficulty;

    $name = 'LeetCode ' . $n . ($title !== '' ? '. ' . $title : '');
    $lines = [];
    $lines[] = 'I want to check that I understand what a coding problem is asking before I try to solve it. Interview me about the problem below. Do not solve it for me.';
    $lines[] = '';
    $lines[] = 'Problem: ' . $name . ($diffLabel !== '' ? ' (' . $diffLabel . ')' : '');
    if ($link !== '') {
        $lines[] = 'Link: ' . $link;
    }
    $lines[] = '';
    if ($kind === 'full' && $statement !== '') {
        $lines[] = 'Problem statement:';
        $lines[] = '"""';
        $lines[] = $statement;
        $lines[] = '"""';
    } elseif ($statement !== '') {
        $lines[] = 'This is a LeetCode Premium problem, so the full statement is not public. Here is the restatement I have:';
        $lines[] = '"""';
        $lines[] = $statement;
        $lines[] = '"""';
        $lines[] = 'If you know the official statement, use it, and tell me if this restatement misses anything important.';
    } else {
        $lines[] = 'The full statement is not available here. Before you start, ask me to paste the statement from LeetCode. If you already know this problem well, confirm the statement with me first.';
    }
    $lines[] = '';
    $lines[] = 'How to interview me:';
    $lines[] = '- Ask one question at a time, then wait for my answer before you ask the next one.';
    $lines[] = '- Open with exactly this question: "In your own words, what is this problem asking you to do? Or do you want to be quizzed right away?"';
    $lines[] = '- If I answer in my own words, check that answer first, then probe the parts I missed or got wrong.';
    $lines[] = '- If I say I want to be quizzed, skip my restatement and go straight to quizzing me on what the problem asks, starting with the inputs.';
    $lines[] = '- Either way, probe each part of the ask: the inputs (types, shapes, value ranges), the expected output and its exact format, the constraints and what they say about input size, edge cases (for example empty or single-element input, duplicates, negatives, no valid answer), and the examples (have me work one by hand to get the expected output).';
    $lines[] = '- Use the Socratic method. If I get something wrong, do not correct me outright. Ask a follow-up question that helps me notice it.';
    $lines[] = '- Do not solve the problem, do not name the algorithm or data structure to use, and do not write code. If I ask for the solution, remind me this session is only about understanding the ask.';
    $lines[] = '- After about 5 to 8 questions, or when I say "done", give me a short assessment: what I understand well, what I misunderstood or missed, and a verdict of "Ready to solve", "Almost there", or "Re-read the problem", with the part of the statement to re-read.';
    $lines[] = '';
    $lines[] = 'Ask your first question now.';

    return implode("\n", $lines);
}

/**
 * Data for the Check understanding button on a page's problem panel.
 * $fallback is the page's own restatement (used when the statement is not public).
 *
 * @param array<string, mixed> $meta
 * @return array{n: int, title: string, difficulty: string, url: string, statement: string, statement_kind: string, prompt: string}|null
 */
function problem_check_understanding_data(array $meta, string $fallback = ''): ?array
{
    $n = content_leetcode_number($meta);
    if ($n === null) {
        return null;
    }
    $statement = problem_statement_text($n);
    $kind = 'full';
    if ($statement === '') {
        $statement = trim($fallback);
        $kind = $statement !== '' ? 'restated' : 'none';
    }
    $data = [
        'n' => $n,
        'title' => game_problem_title($n),
        'difficulty' => content_leetcode_difficulty_for_meta($meta) ?? '',
        'url' => content_leetcode_url($n) ?? '',
        'statement' => $statement,
        'statement_kind' => $kind,
    ];
    $data['prompt'] = problem_check_understanding_prompt($data);
    return $data;
}

/** First paragraph of a Markdown body: a page's own restatement when a statement is not public. */
function problem_restatement_from_markdown(string $markdown): string
{
    $parts = preg_split("/\r?\n\s*\r?\n/", trim($markdown));
    foreach ($parts ?: [] as $part) {
        $part = trim($part);
        if ($part === '' || $part[0] === '#' || strncmp($part, '```', 3) === 0 || strncmp($part, '>', 1) === 0) {
            continue;
        }
        return $part;
    }
    return '';
}

/** Check understanding button, placed at the top right of a problem panel. */
function problem_check_understanding_button_html(): string
{
    return '<button type="button" class="coaching-ai-open check-understanding-open" data-check-understanding-open'
        . ' aria-haspopup="dialog" aria-controls="check-understanding-modal">'
        . '<span class="coaching-ai-open__icon" aria-hidden="true">✨</span>'
        . '<span>Check understanding</span></button>';
}

/**
 * Prompt builder modal for Check understanding. Set $withIcons when the page does not
 * already define the #icon-chatgpt / #icon-claude symbols.
 *
 * @param array<string, mixed>|null $data from problem_check_understanding_data()
 */
function render_check_understanding_modal(?array $data, bool $withIcons): void
{
    if ($data === null) {
        return;
    }
    $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP);
    if (!is_string($json)) {
        return;
    }
    $hint = $data['statement_kind'] === 'full'
        ? 'The prompt already holds this problem\'s statement. Paste it into ChatGPT or Claude and answer its questions to see whether you understand the ask.'
        : ($data['statement_kind'] === 'restated'
            ? 'This is a Premium problem, so the prompt holds this page\'s restatement instead of the official statement.'
            : 'This page has no public statement for this problem, so the AI will ask you to paste it first.');
    ?>
<script type="application/json" id="check-understanding-data"><?= $json ?></script>
<?php if ($withIcons): ?>
<svg class="app-icon-symbols" width="0" height="0" aria-hidden="true" focusable="false">
    <symbol id="icon-chatgpt" viewBox="0 0 512 512">
        <path d="M196.4 185.8l0-48.6c0-4.1 1.5-7.2 5.1-9.2l97.8-56.3c13.3-7.7 29.2-11.3 45.6-11.3 61.4 0 100.4 47.6 100.4 98.3 0 3.6 0 7.7-.5 11.8L343.3 111.1c-6.1-3.6-12.3-3.6-18.4 0L196.4 185.8zM424.7 375.2l0-116.2c0-7.2-3.1-12.3-9.2-15.9L287 168.4 329 144.3c3.6-2 6.7-2 10.2 0L437 200.7c28.2 16.4 47.1 51.2 47.1 85 0 38.9-23 74.8-59.4 89.6l0 0zM166.2 272.8l-42-24.6c-3.6-2-5.1-5.1-5.1-9.2l0-112.6c0-54.8 42-96.3 98.8-96.3 21.5 0 41.5 7.2 58.4 20L175.4 108.5c-6.1 3.6-9.2 8.7-9.2 15.9l0 148.5 0 0zm90.4 52.2l-60.2-33.8 0-71.7 60.2-33.8 60.2 33.8 0 71.7-60.2 33.8zm38.7 155.7c-21.5 0-41.5-7.2-58.4-20l100.9-58.4c6.1-3.6 9.2-8.7 9.2-15.9l0-148.5 42.5 24.6c3.6 2 5.1 5.1 5.1 9.2l0 112.6c0 54.8-42.5 96.3-99.3 96.3l0 0zM173.8 366.5L76.1 310.2c-28.2-16.4-47.1-51.2-47.1-85 0-39.4 23.6-74.8 59.9-89.6l0 116.7c0 7.2 3.1 12.3 9.2 15.9l128 74.2-42 24.1c-3.6 2-6.7 2-10.2 0zm-5.6 84c-57.9 0-100.4-43.5-100.4-97.3 0-4.1 .5-8.2 1-12.3l100.9 58.4c6.1 3.6 12.3 3.6 18.4 0l128.5-74.2 0 48.6c0 4.1-1.5 7.2-5.1 9.2l-97.8 56.3c-13.3 7.7-29.2 11.3-45.6 11.3l0 0zm127 60.9c62 0 113.7-44 125.4-102.4 57.3-14.9 94.2-68.6 94.2-123.4 0-35.8-15.4-70.7-43-95.7 2.6-10.8 4.1-21.5 4.1-32.3 0-73.2-59.4-128-128-128-13.8 0-27.1 2-40.4 6.7-23-22.5-54.8-36.9-89.6-36.9-62 0-113.7 44-125.4 102.4-57.3 14.8-94.2 68.6-94.2 123.4 0 35.8 15.4 70.7 43 95.7-2.6 10.8-4.1 21.5-4.1 32.3 0 73.2 59.4 128 128 128 13.8 0 27.1-2 40.4 6.7 23 22.5 54.8 36.9 89.6 36.9z"></path>
    </symbol>
    <symbol id="icon-claude" viewBox="0 0 512 512">
        <path d="M100.4 340.5l100.7-56.5 1.7-4.9-1.7-2.7-4.9 0-16.8-1-57.5-1.6-49.9-2.1-48.3-2.6-12.2-2.6-11.4-15 1.2-7.5 10.2-6.9 14.7 1.3c18.9 1.3 45.9 3.1 81 5.6l35.2 2.1 52.2 5.4 8.3 0 1.2-3.4-2.8-2.1-2.2-2.1-50.3-34.1-54.4-36-28.5-20.7-15.4-10.5-7.8-9.8-3.4-21.5 14-15.4 18.8 1.3 4.8 1.3 19 14.7 40.7 31.5 53.1 39.1 7.8 6.5 3.1-2.2 .4-1.6-3.5-5.8-28.9-52.2-30.8-53.1-13.7-22-3.6-13.2c-1.3-5.4-2.2-10-2.2-15.5l15.9-21.6 8.8-2.8 21.2 2.8 8.9 7.8 13.2 30.2 21.4 47.5 33.2 64.6 9.7 19.2 5.2 17.8 1.9 5.4 3.4 0 0-3.1 2.7-36.4 5-44.7 4.9-57.5 1.7-16.2 8-19.4 15.9-10.5 12.4 5.9 10.2 14.7-1.4 9.5-6.1 39.5-11.9 61.9-7.8 41.5 4.5 0 5.2-5.2 21-27.8 35.2-44.1 15.5-17.5 18.1-19.3 11.6-9.2 22 0 16.2 24.1-7.3 24.9-22.7 28.7-18.8 24.4-27 36.3-16.8 29 1.6 2.3 4-.4 60.9-13 32.9-5.9 39.3-6.7 17.8 8.3 1.9 8.4-7 17.2-42 10.4-49.2 9.8-73.3 17.3-.9 .7 1 1.3 33 3.1 14.1 .8 34.6 0 64.4 4.8 16.8 11.1 10.1 13.6-1.7 10.4-25.9 13.2c-15.5-3.7-54.4-12.9-116.6-27.7l-28-7-3.9 0 0 2.3 23.3 22.8 42.7 38.6 53.5 49.8 2.7 12.3-6.9 9.7-7.3-1-47-35.4-18.1-15.9-41.1-34.6-2.7 0 0 3.6 9.5 13.9 50 75.2 2.6 23-3.6 7.5-13 4.5-14.2-2.6-29.3-41.1-30.2-46.3-24.4-41.5-3 1.7-14.4 154.8-6.7 7.9-15.5 5.9-13-9.8-6.9-15.9 6.9-31.5 8.3-41.1 6.7-32.7 6.1-40.6 3.6-13.5-.2-.9-3 .4-30.6 42-46.5 62.9-36.8 39.4-8.8 3.5-15.3-7.9 1.4-14.1 8.5-12.6 50.9-64.8 30.7-40.2 19.8-23.2-.1-3.4-1.2 0-135.3 87.8-24.1 3.1-10.4-9.7 1.3-15.9 4.9-5.2 40.7-28-.1 .1 0 .1z"></path>
    </symbol>
</svg>
<?php endif; ?>
<div id="check-understanding-modal" class="modal" hidden>
    <div class="modal__backdrop" data-action="close-check-understanding"></div>
    <div class="modal__panel modal__panel--wide" role="dialog" aria-modal="true" aria-labelledby="check-understanding-title" tabindex="-1">
        <header class="modal__header">
            <h3 id="check-understanding-title" class="modal__title">Check understanding</h3>
            <p class="modal__subtitle">Have ChatGPT or Claude interview you on what LeetCode <?= (int) $data['n'] ?> is asking</p>
        </header>
        <div class="import-modal__body">
            <p class="import-modal__hint"><?= e($hint) ?></p>
            <div class="import-ai-panel">
                <label class="import-ai-panel__preview-label" for="check-understanding-mine">What you think it asks (optional)</label>
                <textarea id="check-understanding-mine" class="guide-ask-question" rows="3" placeholder="In your own words, what does this problem want? The AI will start by checking this."></textarea>
                <p class="import-ai-panel__preview-label">Prompt preview</p>
                <pre id="check-understanding-preview" class="import-ai-panel__preview import-ai-panel__preview--tall"></pre>
                <div class="import-ai-panel__actions">
                    <button type="button" id="check-understanding-copy" class="import-ai-panel__copy">Copy prompt</button>
                    <span class="import-ai-panel__open-label">Open in</span>
                    <a href="https://chatgpt.com/" target="_blank" rel="noopener noreferrer" id="check-understanding-open-chatgpt" class="import-ai-panel__service"><svg class="import-ai-panel__service-icon import-ai-panel__service-icon--chatgpt" width="14" height="14" aria-hidden="true" focusable="false"><use href="#icon-chatgpt"></use></svg><span>ChatGPT</span></a>
                    <a href="https://claude.ai/new" target="_blank" rel="noopener noreferrer" id="check-understanding-open-claude" class="import-ai-panel__service"><svg class="import-ai-panel__service-icon import-ai-panel__service-icon--claude" width="14" height="14" aria-hidden="true" focusable="false"><use href="#icon-claude"></use></svg><span>Claude</span></a>
                </div>
            </div>
        </div>
        <footer class="modal__footer">
            <button type="button" id="check-understanding-done" class="modal__done">Done</button>
        </footer>
    </div>
</div>
    <?php
}

/**
 * "Or problems most companies ask": a link under Find a company in the gallery Filter's
 * Companies flyout. It opens the right slide-in that render_company_problems_panel() prints.
 */
function render_company_problems_link(string $type): void
{
    if (!isset(problem_panel_types()[$type])) {
        return;
    }
    ?>
<p class="filter-company-interviews"><button type="button" class="filter-company-interviews__link company-problems-open" id="company-problems-open" aria-expanded="false" aria-controls="company-problems-panel" aria-haspopup="dialog">Or problems most companies ask</button></p>
    <?php
}

/**
 * The right slide-in (backdrop + panel) for "Problems with most interviews". Printed next to
 * the Filter control; app.js moves it to <body>. $type is games, guides, or coaching.
 */
function render_company_problems_panel(string $type): void
{
    $types = problem_panel_types();
    if (!isset($types[$type])) {
        return;
    }
    $label = $types[$type]['label'];
    $endpoint = url('api/problems-by-company.php?type=' . rawurlencode($type));
    ?>
<div id="company-problems-root" class="recent-root company-problems-root" aria-hidden="true" data-endpoint="<?= e($endpoint) ?>">
    <button type="button" class="recent-backdrop" data-company-problems-close aria-label="Close problems with most interviews" tabindex="-1"></button>
    <aside id="company-problems-panel" class="recent-panel company-problems-panel" role="dialog" aria-modal="true" aria-labelledby="company-problems-title">
        <div class="recent-header">
            <div>
                <h2 id="company-problems-title" class="recent-title">Problems with most interviews</h2>
                <p class="company-problems__sub"><?= e($label) ?> asked in interviews at the most companies first. Problems no company tags are not shown.</p>
            </div>
            <button type="button" class="recent-close" data-company-problems-close aria-label="Close problems with most interviews"><span aria-hidden="true">×</span></button>
        </div>
        <div class="company-problems__search">
            <label class="recent-filter__label" for="company-problems-q">Find</label>
            <input type="search" id="company-problems-q" class="company-problems__input" placeholder="Number or title" autocomplete="off">
        </div>
        <p class="recent-summary" id="company-problems-summary" aria-live="polite"></p>
        <div class="recent-body">
            <ol id="company-problems-list" class="company-problems__list"></ol>
        </div>
    </aside>
</div>
    <?php
}
