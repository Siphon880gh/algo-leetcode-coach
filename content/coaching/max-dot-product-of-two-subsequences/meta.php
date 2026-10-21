<?php
declare(strict_types=1);

return [
    'title' => 'Max Dot Product of Two Subsequences: non-empty DP',
    'leetcode' => 1458,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] = max(p, p + dp[i−1][j−1], dp[i−1][j], dp[i][j−1]) with p = a[i]·b[j] and −∞ borders. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'max-dot-product-of-two-subsequences',
    'tags' => ['dp', 'step-by-step'],
];
