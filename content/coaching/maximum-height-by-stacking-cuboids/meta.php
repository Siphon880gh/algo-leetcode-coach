<?php
declare(strict_types=1);

return [
    'title' => 'Stacking Cuboids: sort dimensions, then LIS',
    'leetcode' => 1691,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort each cuboid\'s dimensions, sort the cuboids, dp[i] = height[i] + best dp[j] that fits under i in all three dimensions. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-height-by-stacking-cuboids',
    'tags' => ['dynamic-programming', 'sorting', 'step-by-step'],
];
