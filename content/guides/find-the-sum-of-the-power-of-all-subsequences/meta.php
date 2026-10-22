<?php
declare(strict_types=1);

return [
    'title' => 'Find the Sum of the Power of All Subsequences: three choices per element',
    'leetcode' => 3082,
    'difficulty' => 'Hard',
    'summary' => 'Count pairs (T, U) with U ⊆ T and sum(U) = k. Each element is outside T, in T but not U, or in U: f[j] becomes 2·f[j] + f[j − x].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'knapsack', 'leetcode'],
    'related_session' => 'find-the-sum-of-the-power-of-all-subsequences',
];
