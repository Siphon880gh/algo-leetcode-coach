<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Distribute Candies: Stirling numbers',
    'leetcode' => 1692,
    'difficulty' => 'Hard',
    'summary' => 'This is the Stirling number of the second kind: dp[i][j] = dp[i − 1][j − 1] + j · dp[i − 1][j]. The new candy either opens a new bag or joins one of the j existing bags.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'combinatorics', 'leetcode'],
    'related_session' => 'count-ways-to-distribute-candies',
];
