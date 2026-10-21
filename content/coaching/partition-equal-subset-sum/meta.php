<?php
declare(strict_types=1);

return [
    'title' => 'Partition Equal Subset Sum: 0-1 knapsack to half the total',
    'leetcode' => 416,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: can nums split into two subsets with equal sum? Odd total is false. Otherwise ask whether some subset hits m = total / 2, each value used once. 1D boolean table, f[0] = true, j walks down from m to x. [1,5,11,5] → true. [1,2,3,5] → false. Not 698 / 494. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'knapsack', '0-1-knapsack', 'step-by-step'],
    'related_guide' => 'partition-equal-subset-sum',
];
