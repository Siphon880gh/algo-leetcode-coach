<?php
declare(strict_types=1);

return [
    'title' => 'Max Dot Product of Two Subsequences: LCS-style DP, non-empty',
    'leetcode' => 1458,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = best for prefixes, taking the max of: pair i with j (optionally extending dp[i−1][j−1] if positive), skip i, or skip j. Non-empty subsequences mean the all-negative case must still pick one pair.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'leetcode'],
    'related_session' => 'max-dot-product-of-two-subsequences',
];
