<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Earnings From Taxi: DP on points',
    'leetcode' => 2008,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i] = max(dp[i − 1], dp[start] + gain) over rides ending at i. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-earnings-from-taxi',
    'tags' => ['dynamic-programming', 'array', 'step-by-step'],
];
