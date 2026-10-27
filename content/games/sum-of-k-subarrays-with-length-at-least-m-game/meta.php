<?php
declare(strict_types=1);

return [
    'title' => 'Sum of K Subarrays With Length at Least M',
    'leetcode' => 3473,
    'difficulty' => 'Med',
    'summary' => 'dp[t][i] = best sum using t subarrays within nums[..i). Either skip element i−1, or end the t-th subarray at i with start at most i − m (prefix sums plus a running max of dp[t−1][j] − P[j]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'sum-of-k-subarrays-with-length-at-least-m',
    'related_session' => 'sum-of-k-subarrays-with-length-at-least-m',
];
