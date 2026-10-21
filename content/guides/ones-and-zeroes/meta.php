<?php
declare(strict_types=1);

return [
    'title' => 'Ones and Zeroes: 0-1 knapsack with two capacities',
    'leetcode' => 474,
    'difficulty' => 'Med',
    'summary' => 'Largest subset of binary strings with at most m zeros and n ones in total. Each string is an item with two weights (its zeros and ones) and value 1. 2D table f[j][k] = best count with j zeros and k ones; for each string, walk j and k downward so each string is used once. ["10","0001","111001","1","0"], 5, 3 → 4.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'knapsack', '0-1-knapsack', 'leetcode'],
    'related_session' => 'ones-and-zeroes',
];
