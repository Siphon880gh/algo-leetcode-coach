<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Amount of Money Robot Can Earn: DP with neutralizations used',
    'leetcode' => 3418,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j][k] is the best profit at (i, j) having used k ≤ 2 neutralizations. Each cell adds its coins, or, when it is a robber and k ≥ 1, takes the k − 1 state without the loss. Profits can be negative, so start from −∞.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'maximum-amount-of-money-robot-can-earn',
];
