<?php
declare(strict_types=1);

return [
    'title' => 'Paint House: cheapest total ending in each color',
    'leetcode' => 256,
    'difficulty' => 'Med',
    'summary' => 'dp[i][c] = costs[i][c] + the smaller of the other two colors at house i−1. The answer is the min of the last row.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'paint-house',
    'related_session' => 'paint-house',
];
