<?php
/**
 * LeetCode problem statements, stored once per problem in content/problems/{n}.html.
 * Files are sanitized (allowlisted tags, no attributes except img src/alt) by
 * .agents/skills/fetch-leetcode-problems/scripts/build.py from the gitignored
 * cache in context/leetcode-problems/. Premium problems are listed in
 * content/problems/premium.json and get a fallback notice instead of a statement,
 * unless the visitor has unlocked premium (includes/premium.php) and
 * content/problems/premium/{n}.php exists (built from context/doocs-leetcode by
 * .agents/skills/fetch-leetcode-problems/scripts/build_premium.py, gitignored).
 * Rendered at the top of algo guides and Step-by-step sessions.
 */

declare(strict_types=1);

require_once __DIR__ . '/content.php';

function problem_statement_dir(): string
{
    return content_root() . '/problems';
}

function problem_statement_html(int $n): ?string
{
    $premium = problem_premium_statement_html($n);
    if ($premium !== null) {
        return $premium;
    }
    $path = problem_statement_dir() . '/' . $n . '.html';
    if (!is_file($path)) {
        return null;
    }
    $html = file_get_contents($path);
    if ($html === false || trim($html) === '') {
        return null;
    }
    return $html;
}

/** @return array<int, true> */
function problem_premium_numbers(): array
{
    return premium_numbers();
}

/**
 * Full premium statement, only for unlocked visitors. Each file starts with a
 * one-line PHP guard (so a direct request gets a 404) followed by sanitized HTML.
 */
function problem_premium_statement_html(int $n): ?string
{
    if (!problem_is_premium($n) || !premium_unlocked()) {
        return null;
    }
    $path = problem_statement_dir() . '/premium/' . $n . '.php';
    if (!is_file($path)) {
        return null;
    }
    $raw = file_get_contents($path);
    if ($raw === false) {
        return null;
    }
    if (strncmp($raw, '<?php', 5) === 0) {
        $nl = strpos($raw, "\n");
        $raw = $nl === false ? '' : substr($raw, $nl + 1);
    }
    return trim($raw) === '' ? null : $raw;
}

/** Unlocked visitor and a built full statement exist for this premium problem. */
function problem_has_premium_statement(int $n): bool
{
    return problem_premium_statement_html($n) !== null;
}

/**
 * Drop a guide's leading "Restated from memory" paragraph once the full statement shows.
 */
function problem_strip_restated_intro(string $markdown): string
{
    $parts = preg_split("/\r?\n\s*\r?\n/", ltrim($markdown), 2);
    if (is_array($parts) && count($parts) === 2 && stripos($parts[0], 'Restated from memory') !== false) {
        return $parts[1];
    }
    return $markdown;
}

function problem_is_premium(int $n): bool
{
    return isset(problem_premium_numbers()[$n]);
}

/**
 * Plain-text version of a statement, for AI prompt builders.
 */
function problem_statement_text(int $n): string
{
    $html = problem_statement_html($n);
    if ($html === null) {
        return '';
    }
    $t = preg_replace('#<sup>(.*?)</sup>#s', '^$1', $html) ?? $html;
    $t = preg_replace('#<sub>(.*?)</sub>#s', '_$1', $t) ?? $t;
    $t = preg_replace('#<img[^>]*alt="([^"]*)"[^>]*>#', '[image: $1]', $t) ?? $t;
    $t = preg_replace('#<li>#', '- ', $t) ?? $t;
    $t = preg_replace('#</(p|li|pre|div|tr|ul|ol|table)>|<br>#', "\n", $t) ?? $t;
    $t = html_entity_decode(strip_tags($t), ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $t = preg_replace("/[ \t]+\n/", "\n", $t) ?? $t;
    $t = preg_replace("/\n{3,}/", "\n\n", $t) ?? $t;
    return trim($t);
}

/**
 * Problem section for a guide ('guide') or a collapsible header for a session ('session').
 * Renders nothing when the page has no LeetCode number.
 */
function render_problem_statement(array $meta, string $variant = 'guide', bool $open = true): void
{
    $n = content_leetcode_number($meta);
    if ($n === null) {
        return;
    }
    $url = content_leetcode_url($n);
    $html = problem_statement_html($n);

    if ($html !== null) {
        $badge = problem_has_premium_statement($n)
            ? '<p class="problem-statement__badge"><span class="premium-badge">Premium</span></p>'
            : '';
        $body = $badge . '<div class="problem-statement__body">' . $html . '</div>';
    } else {
        $why = problem_is_premium($n)
            ? 'This is a LeetCode Premium problem, so its statement is not public.'
            : 'The statement has not been fetched yet.';
        $body = '<p class="problem-statement__fallback">' . e($why)
            . ($variant === 'session'
                ? ' The first step below restates the essentials.'
                : ' The overview below restates the essentials.')
            . '</p>';
    }
    $source = '<p class="problem-statement__source">'
        . ($url !== null
            ? 'Source: <a href="' . e($url) . '" target="_blank" rel="noopener noreferrer">LeetCode ' . $n . '</a>'
            : 'Source: LeetCode ' . $n)
        . '</p>';

    if ($variant === 'session') {
        echo '<details class="problem-statement problem-statement--session"' . ($open ? ' open' : '') . '>'
            . '<summary class="problem-statement__summary">Problem</summary>'
            . $body . $source . '</details>';
        return;
    }

    echo '<section class="problem-statement" aria-labelledby="problem-statement-heading">'
        . '<h2 id="problem-statement-heading" class="problem-statement__heading">Problem</h2>'
        . $body . $source . '</section>';
}
