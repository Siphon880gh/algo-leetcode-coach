<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Value of K Coins From Piles: knapsack over piles',
    'leetcode' => 2218,
    'difficulty' => 'Hard',
    'summary' => 'dp[j] = best value with j coins from piles seen so far. For each pile, try taking its top t coins (prefix sum) for every t, as a grouped knapsack.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'maximum-value-of-k-coins-from-piles',
];
