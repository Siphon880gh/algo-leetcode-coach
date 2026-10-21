<?php
declare(strict_types=1);

return [
    'title' => 'Target Sum: count subsets that sum to (total − target) / 2',
    'leetcode' => 494,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count +/− sign choices equal to target. total − 2 × neg = target gives neg = (total − target) / 2; if negative or odd, 0. Count subsets with sum neg by 0-1 knapsack, j walking down. [1,1,1,1,1], 3 → 5. Not 416. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'knapsack', 'backtracking', 'step-by-step'],
    'related_guide' => 'target-sum',
];
