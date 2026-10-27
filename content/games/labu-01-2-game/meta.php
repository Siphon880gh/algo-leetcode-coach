<?php
declare(strict_types=1);

return [
    'title' => '0-1 Knapsack: 1D Array',
    'summary' => 'Squash the 2D table into one array dp[c]. For each item, scan c from the capacity down to w: dp[c] = max(dp[c], dp[c − w] + v). Going downward means dp[c − w] still holds the previous row, so no item is taken twice.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-01-2',
    'related_session' => 'labu-01-2',
];
