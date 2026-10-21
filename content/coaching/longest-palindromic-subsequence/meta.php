<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindromic Subsequence: interval DP on the two ends',
    'leetcode' => 516,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: longest palindromic subsequence. Interval DP on the ends: match → f[i + 1][j − 1] + 2, else max of dropping one end. f[i][i] = 1. Fill i from the end. "bbbab" → 4. "cbbd" → 2. Not 5. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'strings', 'interval-dp', 'step-by-step'],
    'related_guide' => 'longest-palindromic-subsequence',
];
