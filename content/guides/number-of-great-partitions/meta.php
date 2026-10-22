<?php
declare(strict_types=1);

return [
    'title' => 'Number of Great Partitions: subtract the small subsets twice',
    'leetcode' => 2518,
    'difficulty' => 'Hard',
    'summary' => 'If the total is below 2k, nothing works. Otherwise a split fails exactly when one side sums below k, and the two sides cannot both be that small. Count subsets with sum below k by knapsack, and subtract twice that from 2^n.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-great-partitions',
];
