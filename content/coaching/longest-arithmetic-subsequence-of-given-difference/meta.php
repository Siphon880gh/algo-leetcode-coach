<?php
declare(strict_types=1);

return [
    'title' => 'Longest Arithmetic Subsequence of Given Difference: one map',
    'leetcode' => 1218,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each x, set best[x] = best[x − difference] + 1, and return the largest value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-arithmetic-subsequence-of-given-difference',
    'tags' => ['dynamic-programming', 'hash-table', 'step-by-step'],
];
