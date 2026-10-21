<?php
declare(strict_types=1);

return [
    'title' => 'Form Largest Integer With Digits That Add up to Target: length DP then greedy',
    'leetcode' => 1449,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[t] = max digits for cost t (unbounded knapsack); then build from 9 down, taking d while dp[t − cost[d]] == dp[t] − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'form-largest-integer-with-digits-that-add-up-to-target',
    'tags' => ['dp', 'knapsack', 'greedy', 'step-by-step'],
];
