<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Subsequence: the classic grid',
    'leetcode' => 1143,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i][j] is the LCS of the first i and j characters; equal letters extend the diagonal, otherwise take the better of dropping one. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-common-subsequence',
    'tags' => ['dynamic-programming', 'strings', 'step-by-step'],
];
