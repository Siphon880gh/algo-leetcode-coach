<?php
declare(strict_types=1);

return [
    'title' => '0-1 Knapsack: 2D Table',
    'summary' => 'dp[i][c] = best value using only the first i items with capacity c. Skip item i: dp[i − 1][c]. Take it (if w at most c): dp[i − 1][c − w] + v. Keep the larger. Row 0 is all zeros.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-01-1',
    'related_session' => 'labu-01-1',
];
