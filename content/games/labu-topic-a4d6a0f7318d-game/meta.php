<?php
declare(strict_types=1);

return [
    'title' => 'Multiple (Bounded) Knapsack',
    'summary' => 'Item i may be taken up to k_i times. For each item, for each capacity c from high to low, try every count t from 0 to k_i with t × w ≤ c: dp[c] = max(dp[c], dp[c − t × w] + t × v). Downward order keeps dp[c − t × w] free of this item.',
    'category' => 'Algorithms',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'Algorithms · Dynamic Programming',
    'tags' => ['dp', 'mini-game'],
    'entry' => 'index.html',
    'related_guide' => 'labu-topic-a4d6a0f7318d',
    'related_session' => 'labu-topic-a4d6a0f7318d',
];
