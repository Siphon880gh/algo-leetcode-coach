<?php
declare(strict_types=1);

return [
    'title' => 'Factor Combinations',
    'leetcode' => 254,
    'difficulty' => 'Med',
    'summary' => 'Backtrack with non-decreasing factors: for f from start while f·f ≤ n, if f divides n, record path + [f, n/f] and recurse on n/f starting at f.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'factor-combinations',
    'related_session' => 'factor-combinations',
];
