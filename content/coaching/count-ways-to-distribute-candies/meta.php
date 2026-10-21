<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Distribute Candies: Stirling recurrence',
    'leetcode' => 1692,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp[i][j] = dp[i − 1][j − 1] + j · dp[i − 1][j]; the new candy opens a bag or joins one of j bags. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-ways-to-distribute-candies',
    'tags' => ['dynamic-programming', 'combinatorics', 'step-by-step'],
];
