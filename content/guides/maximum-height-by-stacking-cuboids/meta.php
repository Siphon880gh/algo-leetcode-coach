<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Height by Stacking Cuboids: sort dimensions, then LIS',
    'leetcode' => 1691,
    'difficulty' => 'Hard',
    'summary' => 'Rotate every cuboid so its dimensions are sorted and use the largest as height. Sort the cuboids; dp[i] = height[i] + max dp[j] over j that fit under i in all three dimensions.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximum-height-by-stacking-cuboids',
];
