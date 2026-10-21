<?php
declare(strict_types=1);

return [
    'title' => 'Longest Repeating Substring: DP on end positions',
    'leetcode' => 1062,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i][j] for i < j is the length of the common substring ending at positions i and j; it extends dp[i − 1][j − 1] when the letters match. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-repeating-substring',
    'tags' => ['dynamic-programming', 'strings', 'binary-search', 'rolling-hash', 'step-by-step'],
];
