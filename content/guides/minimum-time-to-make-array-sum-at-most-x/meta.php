<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Make Array Sum At Most x: sort by growth, knapsack',
    'leetcode' => 2809,
    'difficulty' => 'Hard',
    'summary' => 'Each index needs resetting at most once, and later resets should go to faster growers. Sort by nums2, let dp[j] be the most you can remove with j resets, and find the smallest t with sum1 + t · sum2 − dp[t] ≤ x.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'minimum-time-to-make-array-sum-at-most-x',
];
