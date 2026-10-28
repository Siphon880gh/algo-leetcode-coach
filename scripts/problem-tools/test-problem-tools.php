<?php
// Tests for includes/problem_tools.php: the "Problems with most interviews" slide-in list and the
// "Check understanding" prompt. Plain PHP, no dependencies.
// usage: php scripts/problem-tools/test-problem-tools.php
declare(strict_types=1);

chdir(dirname(__DIR__, 2));
require 'includes/problem_tools.php';

$fail = 0;
$pass = 0;
function check(bool $ok, string $label): void
{
    global $fail, $pass;
    if ($ok) {
        $pass++;
        return;
    }
    $fail++;
    echo "FAIL $label\n";
}

// ---- Sorting and filtering (pure) ----
$items = [
    ['slug' => 'b-game', 'meta' => ['title' => 'B', 'leetcode' => 20, 'difficulty' => 'Easy']],
    ['slug' => 'a-game', 'meta' => ['title' => 'A', 'leetcode' => 3]],
    ['slug' => 'c-game', 'meta' => ['title' => 'C', 'leetcode' => 7]],
    ['slug' => 'no-co', 'meta' => ['title' => 'No companies', 'leetcode' => 99]],
    ['slug' => 'extra', 'meta' => ['title' => 'Extras page']],
    ['slug' => 'dup-of-3', 'meta' => ['title' => 'Duplicate 3', 'leetcode' => 3]],
    ['slug' => 'str-num', 'meta' => ['title' => 'String number', 'leetcode' => '5']],
];
$slugsByProblem = [
    3 => ['google', 'amazon'],
    7 => ['google', 'amazon', 'meta', 'google'], // duplicate slug counts once
    20 => ['google', 'amazon'],
    5 => ['uber'],
    99 => [],
    1234 => ['google'], // no page of this type: not listed
];
$rows = problem_rows_by_company_count($items, $slugsByProblem);
check(array_column($rows, 'n') === [7, 3, 20, 5], 'sorted by company count desc, then problem number asc: ' . json_encode(array_column($rows, 'n')));
check(array_column($rows, 'companies') === [3, 2, 2, 1], 'distinct company counts: ' . json_encode(array_column($rows, 'companies')));
check(!in_array(99, array_column($rows, 'n'), true), 'problems without companies are hidden');
check(!in_array('extra', array_column($rows, 'slug'), true), 'pages without a LeetCode number are hidden');
check(($rows[1]['slug'] ?? '') === 'a-game', 'one row per problem number, first page by slug wins');
check(($rows[0]['title'] ?? '') === 'C', 'row title is the page title');
check(problem_rows_by_company_count([], $slugsByProblem) === [], 'empty items give no rows');

// ---- Real data, every page type ----
foreach (['games' => 'games/play.php?id=', 'guides' => 'guides/view.php?id=', 'coaching' => 'coaching/session.php?id='] as $type => $route) {
    $real = problem_panel_rows($type);
    check(count($real) > 100, "$type has rows (" . count($real) . ')');
    $prev = PHP_INT_MAX;
    $prevN = 0;
    $sorted = true;
    $seen = [];
    foreach ($real as $r) {
        if ($r['companies'] < 1) {
            check(false, "$type row {$r['n']} has no companies");
        }
        if ($r['companies'] > $prev || ($r['companies'] === $prev && $r['n'] < $prevN)) {
            $sorted = false;
        }
        if (strpos($r['url'], $route) === false) {
            check(false, "$type row {$r['n']} links to {$r['url']}");
        }
        if (isset($seen[$r['n']])) {
            check(false, "$type row {$r['n']} listed twice");
        }
        $seen[$r['n']] = true;
        $expected = count(array_unique(content_leetcode_company_slugs($r['n'])));
        if ($r['companies'] !== $expected) {
            check(false, "$type row {$r['n']} count {$r['companies']} != $expected");
        }
        $prev = $r['companies'];
        $prevN = $r['n'];
    }
    check($sorted, "$type rows sorted most companies first");
}
check(problem_panel_rows('nope') === [], 'unknown type gives no rows');

// ---- Check understanding prompt ----
$full = problem_check_understanding_prompt([
    'n' => 1,
    'title' => 'Two Sum',
    'difficulty' => 'Easy',
    'url' => 'https://leetcode.com/problems/two-sum',
    'statement' => 'Given an array of integers nums and an integer target, return indices of the two numbers.',
    'statement_kind' => 'full',
]);
check(strpos($full, 'LeetCode 1. Two Sum') !== false, 'prompt names the problem');
check(strpos($full, 'Given an array of integers nums and an integer target') !== false, 'prompt includes the statement');
check(stripos($full, 'interview me') !== false, 'prompt asks the AI to interview');
check(stripos($full, 'one question at a time') !== false, 'prompt asks one question at a time');
foreach (['inputs', 'output', 'constraints', 'edge cases', 'examples'] as $topic) {
    check(stripos($full, $topic) !== false, "prompt probes $topic");
}
check(stripos($full, 'do not solve') !== false || stripos($full, 'not solve') !== false, 'prompt forbids solving');
check(stripos($full, 'assessment') !== false, 'prompt ends with an assessment');
check(strpos($full, 'https://leetcode.com/problems/two-sum') !== false, 'prompt includes the link');

$restated = problem_check_understanding_prompt([
    'n' => 156, 'title' => 'Binary Tree Upside Down', 'difficulty' => 'Med', 'url' => '',
    'statement' => 'Flip the tree so the leftmost leaf becomes the root.', 'statement_kind' => 'restated',
]);
check(stripos($restated, 'Premium') !== false && strpos($restated, 'Flip the tree') !== false, 'restated premium prompt says so and keeps the restatement');

$none = problem_check_understanding_prompt([
    'n' => 157, 'title' => 'Read N Characters Given Read4', 'difficulty' => 'Easy', 'url' => 'https://leetcode.com/problems/read-n-characters-given-read4',
    'statement' => '', 'statement_kind' => 'none',
]);
check(stripos($none, 'paste') !== false, 'no-statement prompt asks the user to paste the statement');
check(strpos($none, 'LeetCode 157. Read N Characters Given Read4') !== false, 'no-statement prompt still names the problem');

// ---- Page data for the button ----
$data = problem_check_understanding_data(['leetcode' => 1, 'difficulty' => 'Easy'], 'Fallback text');
check(($data['n'] ?? 0) === 1 && ($data['statement_kind'] ?? '') === 'full', 'free problem uses the full statement');
check(strpos((string) ($data['prompt'] ?? ''), 'You are given an array of integers') !== false, 'page prompt carries the stored statement');
check(problem_check_understanding_data(['title' => 'Extra'], '') === null, 'no LeetCode number, no button data');

// ---- Problems with most interviews: a Filter item on the gallery pages, not on detail pages ----
foreach (['games', 'guides', 'coaching'] as $type) {
    ob_start();
    render_company_problems_link($type);
    $item = (string) ob_get_clean();
    check(strpos($item, 'id="company-problems-open"') !== false && strpos($item, 'aria-controls="company-problems-panel"') !== false, "$type link opens the slide-in");
    check(strpos($item, '>Or problems most companies ask</button>') !== false, "$type link reads Or problems most companies ask");
    ob_start();
    render_company_problems_panel($type);
    $html = (string) ob_get_clean();
    check(strpos($html, 'id="company-problems-open"') === false, "$type slide-in has no standalone header button");
    check(strpos($html, '>Problems with most interviews</h2>') !== false && strpos($html, 'by company') === false, "$type slide-in title renamed");
    check(strpos($html, 'api/problems-by-company.php?type=' . $type) !== false, "$type gallery panel loads $type rows");
    check(strpos($html, 'data-current') === false, "$type gallery panel has no current-problem highlight");
}
ob_start();
render_company_problems_panel('nope');
check((string) ob_get_clean() === '', 'unknown gallery type renders nothing');
ob_start();
render_company_problems_link('nope');
check((string) ob_get_clean() === '', 'unknown gallery type renders no link');

// ---- Filter flyouts: Companies has search, then the link, then a divider, then the tiers ----
$groups = content_leetcode_companies_grouped();
ob_start();
render_content_filter_companies($groups, 'games');
$co = (string) ob_get_clean();
$pSearch = strpos($co, 'data-filter-company-search');
$pLink = strpos($co, 'Or problems most companies ask');
$pHr = strpos($co, 'filter-company-divider');
$pTier = strpos($co, 'data-filter-company-level=');
check($pSearch !== false && $pLink > $pSearch && $pHr > $pLink && $pTier > $pHr, 'Companies flyout: Find a company, link, divider, tiers');
ob_start();
render_content_filter_companies($groups);
$co = (string) ob_get_clean();
check(strpos($co, 'company-problems-open') === false && strpos($co, 'filter-company-divider') !== false, 'Companies flyout without a type: divider, no link');
ob_start();
render_content_filter_passes();
$pa = (string) ob_get_clean();
check(substr_count($pa, 'data-user-tag-filters') === 2 && strpos($pa, 'data-tag-group="first-pass"') < strpos($pa, 'data-tag-group="second-pass"'), 'Passes flyout: First pass and Second pass columns');
check(strpos($pa, 'data-filter-tag-group="first-pass second-pass"') !== false && strpos($pa, '</span> First pass</p>') !== false && strpos($pa, '</span> Second pass</p>') !== false, 'Passes flyout: one item covering both groups, with column heads');
foreach (['game' => 'games/index.php', 'guide' => 'guides/index.php', 'session' => 'coaching/index.php'] as $from => $script) {
    ob_start();
    render_resource_head_chrome($from, ['leetcode' => 1, 'difficulty' => 'Easy'], 'two-sum', $script);
    check(strpos((string) ob_get_clean(), 'company-problems') === false, "$from detail page head has no Problems with most interviews");
}

// ---- Problem pages: company names sit above the LeetCode number / difficulty / YouTube line ----
foreach (['game' => 'games/index.php', 'guide' => 'guides/index.php', 'session' => 'coaching/index.php'] as $from => $script) {
    ob_start();
    render_resource_head_chrome($from, ['leetcode' => 1, 'difficulty' => 'Easy', 'title' => 'Two Sum'], 'two-sum', $script);
    $head = (string) ob_get_clean();
    $cos = strpos($head, 'class="leetcode-cos"');
    $line = strpos($head, 'class="leetcode-no__line"');
    check($cos !== false && $line !== false && $cos < $line, "$from page: companies above the number line");
    $names = content_leetcode_company_names(1);
    $first = $names[0] ?? '';
    check($first !== '' && strpos($head, '>' . e($first) . '<') !== false, "$from page: lists company names (first: $first)");
}
$tile = content_leetcode_chrome_html(['leetcode' => 1, 'difficulty' => 'Easy']);
check(strpos($tile, 'leetcode-no__line') < strpos($tile, 'leetcode-cos'), 'gallery tiles keep companies below the number line');
$noCo = null;
for ($i = 1; $i < 5000; $i++) {
    if (content_leetcode_company_names($i) === [] && content_leetcode_url($i) !== null) { $noCo = $i; break; }
}
if ($noCo !== null) {
    $html = content_leetcode_chrome_html(['leetcode' => $noCo], true, true);
    check(strpos($html, 'leetcode-cos') === false && strpos($html, 'leetcode-no__line') !== false, "problem $noCo with no companies shows no company row");
}

echo "problem tools ok $pass bad $fail\n";
exit($fail ? 1 : 0);
