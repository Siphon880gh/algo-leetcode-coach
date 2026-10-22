<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increment Operations to Make Array Beautiful: raised indices at most 3 apart',
    'leetcode' => 2919,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] = cost to raise i plus the best of the previous three. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-increment-operations-to-make-array-beautiful',
    'tags' => ['array', 'dynamic-programming', 'step-by-step'],
];
