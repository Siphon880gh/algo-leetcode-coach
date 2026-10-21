<?php
declare(strict_types=1);

return [
    'title' => 'Earliest and Latest Rounds: search over star positions',
    'leetcode' => 1900,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: state (n, i, j); if they face each other return 1; else try all outcomes of other matches, recurse, and take min/max. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'the-earliest-and-latest-rounds-where-players-compete',
    'tags' => ['dynamic-programming', 'memoization', 'brute-force', 'step-by-step'],
];
