<?php
declare(strict_types=1);

return [
    'title' => 'Ones and Zeroes: 0-1 knapsack with two capacities',
    'leetcode' => 474,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: largest subset of binary strings with at most m zeros and n ones. 0-1 knapsack with two budgets: f[j][k] = max strings using ≤ j zeros and ≤ k ones; for each string walk j and k downward. ["10","0001","111001","1","0"], 5, 3 → 4. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'knapsack', '0-1-knapsack', 'step-by-step'],
    'related_guide' => 'ones-and-zeroes',
];
