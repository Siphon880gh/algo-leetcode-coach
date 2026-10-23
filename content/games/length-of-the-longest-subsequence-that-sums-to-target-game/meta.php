<?php
declare(strict_types=1);

return [
    'title' => 'Longest Subsequence That Sums to Target: knapsack on length',
    'leetcode' => 2915,
    'difficulty' => 'Med',
    'summary' => 'dp[s] = longest subsequence with sum s (−∞ if impossible). For each x, s descending: dp[s] = max(dp[s], dp[s − x] + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'length-of-the-longest-subsequence-that-sums-to-target',
    'related_session' => 'length-of-the-longest-subsequence-that-sums-to-target',
];
