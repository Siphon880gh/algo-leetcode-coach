<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Make Array Sum at most x: reset the slow growers first',
    'leetcode' => 2809,
    'difficulty' => 'Hard',
    'summary' => 'Sort by nums2. Resetting index i at second j saves nums1[i] + j times nums2[i]. dp[j] = most saved with j resets. At time t the sum is sum1 + t times sum2 − dp[t]; find the smallest t with that at most x.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-make-array-sum-at-most-x',
    'related_session' => 'minimum-time-to-make-array-sum-at-most-x',
];
