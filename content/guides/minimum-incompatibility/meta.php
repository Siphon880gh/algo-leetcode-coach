<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Incompatibility: bitmask DP over valid groups',
    'leetcode' => 1681,
    'difficulty' => 'Hard',
    'summary' => 'Precompute every subset of size n/k with distinct values and its max − min. dp[mask] = min cost to fill mask; always place the lowest unused index to avoid permutations.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'leetcode'],
    'related_session' => 'minimum-incompatibility',
];
