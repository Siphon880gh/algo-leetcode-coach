<?php
declare(strict_types=1);

return [
    'title' => 'Complete Knapsack: 1D Array',
    'summary' => 'Each item may be taken any number of times. Scan c from w up to the capacity: dp[c] = max(dp[c], dp[c − w] + v). Going upward lets dp[c − w] already contain copies of the same item.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-0082589b24d1',
    'related_session' => 'labu-topic-0082589b24d1',
];
