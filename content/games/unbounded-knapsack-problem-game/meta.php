<?php
declare(strict_types=1);

return [
    'title' => 'Unbounded Knapsack',
    'summary' => 'Unlimited copies of each item. One array dp[c]; for each item scan c from w up to the capacity: dp[c] = max(dp[c], dp[c − w] + v). The forward scan is what allows repeats.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'unbounded-knapsack-problem',
    'related_session' => 'unbounded-knapsack-problem',
];
