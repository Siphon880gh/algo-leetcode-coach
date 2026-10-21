<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array for Maximum Sum: last block DP',
    'leetcode' => 1043,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] tries every last block of length up to k, growing it leftward while tracking its maximum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'partition-array-for-maximum-sum',
    'tags' => ['dynamic-programming', 'arrays', 'step-by-step'],
];
