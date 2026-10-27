<?php
declare(strict_types=1);

return [
    'title' => 'Count of Monotonic Pairs II: the same DP with prefix sums',
    'leetcode' => 3251,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][v] = the sum of dp[i−1][u] for u at most v − max(0, nums[i] − nums[i−1]); prefix sums make each row O(max value).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-count-of-monotonic-pairs-ii',
    'related_session' => 'find-the-count-of-monotonic-pairs-ii',
];
