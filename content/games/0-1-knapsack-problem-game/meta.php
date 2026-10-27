<?php
declare(strict_types=1);

return [
    'title' => '0-1 Knapsack',
    'summary' => 'dp[c] is the best value that fits in capacity c. For each item (weight w, value v), scan c from the capacity down to w: dp[c] = max(dp[c], dp[c − w] + v). Scanning downward keeps dp[c − w] free of this item, so each item is used at most once.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => '0-1-knapsack-problem',
    'related_session' => '0-1-knapsack-problem',
];
