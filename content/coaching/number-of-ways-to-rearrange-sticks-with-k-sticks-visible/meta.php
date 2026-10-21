<?php
declare(strict_types=1);

return [
    'title' => 'Rearrange Sticks With K Visible: place the shortest stick',
    'leetcode' => 1866,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] = dp[i − 1][j − 1] + (i − 1) · dp[i − 1][j]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-rearrange-sticks-with-k-sticks-visible',
    'tags' => ['dynamic-programming', 'combinatorics', 'math', 'step-by-step'],
];
