<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Height by Stacking Cuboids: sort dims, then LIS',
    'leetcode' => 1691,
    'difficulty' => 'Hard',
    'summary' => 'Rotate each cuboid so its dims are sorted (tallest as height). Sort cuboids. dp[i] = height[i] + max dp[j] where every dim of j ≤ dim of i.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-height-by-stacking-cuboids',
    'related_session' => 'maximum-height-by-stacking-cuboids',
];
