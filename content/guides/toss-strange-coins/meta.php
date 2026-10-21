<?php
declare(strict_types=1);

return [
    'title' => 'Toss Strange Coins: probability DP over heads',
    'leetcode' => 1230,
    'difficulty' => 'Med',
    'summary' => 'dp[k] is the probability of k heads so far. Each coin with probability p updates dp[k] = dp[k] · (1 − p) + dp[k − 1] · p, iterating k downward so one array suffices.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'probability', 'math', 'leetcode'],
    'related_session' => 'toss-strange-coins',
];
