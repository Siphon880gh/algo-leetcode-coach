<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Non-Decreasing Array Length: merge into sums',
    'leetcode' => 2945,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = most pieces for the prefix of length i, last[i] = the smallest possible last piece sum. Choose the largest j with last[j] at most P[i] − P[j]: dp[i] = dp[j] + 1, last[i] = P[i] − P[j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-maximum-non-decreasing-array-length',
    'related_session' => 'find-maximum-non-decreasing-array-length',
];
