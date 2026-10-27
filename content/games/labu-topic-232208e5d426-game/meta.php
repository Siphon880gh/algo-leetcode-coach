<?php
declare(strict_types=1);

return [
    'title' => 'Complete Knapsack: 2D Table',
    'summary' => 'dp[i][c] with unlimited copies of each item. Skip: dp[i − 1][c]. Take: dp[i][c − w] + v, the same row, because that cell may already hold copies of item i. Keep the larger.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-232208e5d426',
    'related_session' => 'labu-topic-232208e5d426',
];
