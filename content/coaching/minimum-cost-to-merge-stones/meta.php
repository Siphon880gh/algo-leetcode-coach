<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Merge Stones: interval DP with k − 1 steps',
    'leetcode' => 1000,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: check (n − 1) % (k − 1) == 0, let dp[i][j] be the least cost to merge stones i..j as far as possible, split at steps of k − 1, and add the range sum when the range collapses to one pile. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-to-merge-stones',
    'tags' => ['dynamic-programming', 'prefix-sum', 'step-by-step'],
];
