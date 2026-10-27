<?php
declare(strict_types=1);

return [
    'title' => 'Max Dot Product of Two Subsequences: pair, extend, or skip',
    'leetcode' => 1458,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = best for nums1[0 to i] and nums2[0 to j] (non-empty). Options: a[i] times b[j] alone, a[i] times b[j] + dp[i−1][j−1], or skip one side: dp[i−1][j], dp[i][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'max-dot-product-of-two-subsequences',
    'related_session' => 'max-dot-product-of-two-subsequences',
];
