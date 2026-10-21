<?php
declare(strict_types=1);

return [
    'title' => 'Target Sum: count subsets that sum to (total − target) / 2',
    'leetcode' => 494,
    'difficulty' => 'Med',
    'summary' => 'Put + or − before each number; count expressions equal to target. If the minus-group sums to neg, then total − 2 × neg = target, so neg = (total − target) / 2. That must be a non-negative integer, else 0. Count subsets with sum neg: 0-1 knapsack counting, j walks down. [1,1,1,1,1], 3 → 5. Not 416.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'knapsack', '0-1-knapsack', 'backtracking', 'leetcode'],
    'related_session' => 'target-sum',
];
