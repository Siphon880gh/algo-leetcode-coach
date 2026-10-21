<?php
declare(strict_types=1);

return [
    'title' => 'Largest Sum of Averages: partition DP with prefix sums',
    'leetcode' => 813,
    'difficulty' => 'Med',
    'summary' => 'dp[k][i] is the best score splitting the first i elements into at most k groups. Each state tries every start j for the last group: dp[k − 1][j] + average(j … i − 1), using prefix sums for the averages.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'prefix-sum', 'arrays', 'leetcode'],
    'related_session' => 'largest-sum-of-averages',
];
