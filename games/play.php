<?php
declare(strict_types=1);

require_once dirname(__DIR__) . '/includes/layout.php';
require_once dirname(__DIR__) . '/includes/problem.php';

/** Readable problem title from its LeetCode URL slug, e.g. "two-sum-ii-input-array-is-sorted". */
function game_problem_title(int $n): string
{
    // Official titles the URL slug cannot spell (punctuation or casing).
    $official = [
        51 => 'N-Queens', 69 => 'Sqrt(x)', 74 => 'Search a 2D Matrix',
        167 => 'Two Sum II - Input Array Is Sorted', 435 => 'Non-overlapping Intervals',
        1679 => 'Max Number of K-Sum Pairs',
    ];
    if (isset($official[$n])) {
        return $official[$n];
    }
    $url = content_leetcode_url($n);
    if ($url === null) {
        return '';
    }
    $words = explode('-', basename(rtrim($url, '/')));
    $upper = ['ii' => 'II', 'iii' => 'III', 'iv' => 'IV', 'bst' => 'BST', 'k' => 'K', 'i' => 'I'];
    $small = ['a', 'an', 'and', 'at', 'by', 'from', 'in', 'of', 'on', 'or', 'the', 'to', 'with'];
    foreach ($words as $i => $w) {
        if (isset($upper[$w])) {
            $words[$i] = $upper[$w];
        } elseif ($i > 0 && in_array($w, $small, true)) {
            $words[$i] = $w;
        } elseif (preg_match('/^(\d+)(sum)$/', $w, $m) === 1) {
            $words[$i] = $m[1] . 'Sum';
        } else {
            $words[$i] = ucfirst($w);
        }
    }
    return implode(' ', $words);
}

/**
 * Collapsible "Problem" panel above the board, open on load. Reuses the stored statements
 * and premium gating from includes/problem.php: locked premium problems get a notice only.
 */
function render_game_problem(array $meta, string $slug): void
{
    $n = content_leetcode_number($meta);
    if ($n === null) {
        return;
    }
    $title = game_problem_title($n);
    $html = problem_statement_html($n);

    if ($html !== null) {
        $badge = problem_has_premium_statement($n)
            ? '<p class="problem-statement__badge"><span class="premium-badge">Premium</span></p>'
            : '';
        $body = $badge . '<div class="problem-statement__body">' . $html . '</div>';
    } else {
        $why = problem_is_premium($n)
            ? 'This is a LeetCode Premium problem, so its statement is not public. The dark setup line in the game shows each round\'s input.'
            : 'The statement has not been fetched yet. The dark setup line in the game shows each round\'s input.';
        $body = '<p class="problem-statement__fallback">' . e($why) . '</p>';
    }

    $links = [content_leetcode_label_html($n)];
    $guide = companion_existing_slug('guides', $meta, $slug, 'related_guide');
    if ($guide !== null) {
        $links[] = '<a href="' . e(url('guides/view.php?id=' . rawurlencode($guide))) . '">Algo Guide</a>';
    }

    echo '<details class="problem-statement problem-statement--session game-problem" id="problem" open>'
        . '<summary class="problem-statement__summary">Problem: ' . e((string) $n) . ($title !== '' ? '. ' . e($title) : '')
        . ' ' . content_leetcode_difficulty_html($meta) . '</summary>'
        . $body
        . '<p class="problem-statement__source">Source: ' . implode(' · ', $links) . '</p>'
        . '</details>';
}

$slug = isset($_GET['id']) ? (string) $_GET['id'] : '';
$item = load_content('games', $slug);

if ($item === null) {
    http_response_code(404);
    layout_start(['title' => 'Game not found', 'active' => 'games']);
    echo '<p class="empty-state">Game not found.</p>';
    echo '<a class="back-link" href="' . e(url('games/index.php')) . '">← All mini games</a>';
    layout_end();
    exit;
}

$meta = $item['meta'];
$entry = (string) ($meta['entry'] ?? 'index.html');
$gameUrl = url('content/games/' . rawurlencode($slug) . '/' . ltrim($entry, '/'));

layout_start([
    'title' => (string) ($meta['title'] ?? $slug),
    'description' => (string) ($meta['summary'] ?? ''),
    'active' => 'games',
]);
?>

<a class="back-link" href="<?= e(url('games/index.php')) ?>">← All mini games</a>

<div class="page-head">
    <?php render_content_crumb($meta, 'games/index.php', []); ?>
    <h1><?= e((string) ($meta['title'] ?? $slug)) ?></h1>
    <?php render_resource_head_chrome('game', $meta, $slug, 'games/index.php'); ?>
    <p><?= e((string) ($meta['summary'] ?? '')) ?></p>
</div>

<?php render_game_problem($meta, $slug); ?>

<div class="game-frame-wrap">
    <iframe
        class="game-frame"
        title="<?= e((string) ($meta['title'] ?? 'Mini game')) ?>"
        src="<?= e($gameUrl) ?>"
        loading="lazy"
    ></iframe>
</div>

<?php
layout_end();
