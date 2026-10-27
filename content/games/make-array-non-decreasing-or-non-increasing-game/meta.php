<?php
declare(strict_types=1);

return [
    'title' => 'Make Array Non-Decreasing or Non-Increasing: DP over target values',
    'leetcode' => 2263,
    'difficulty' => 'Hard',
    'summary' => 'An optimal array uses only original values. dp[v] = least cost with the current element set to v (sorted values); for non-decreasing, dp[v] = |a[i] − v| + min dp[u] over u at most v (a running prefix min). Do it again reversed for non-increasing; take the smaller.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'make-array-non-decreasing-or-non-increasing',
    'related_session' => 'make-array-non-decreasing-or-non-increasing',
];
