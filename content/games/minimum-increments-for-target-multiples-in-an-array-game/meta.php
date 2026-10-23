<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increments for Target Multiples: bitmask over targets',
    'leetcode' => 3444,
    'difficulty' => 'Hard',
    'summary' => 'For each subset of targets, its LCM is what one number must reach. cost(x, mask) = smallest increment to a multiple of lcm(mask). dp[mask] over numbers: each number covers some new subset or nothing.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-increments-for-target-multiples-in-an-array',
    'related_session' => 'minimum-increments-for-target-multiples-in-an-array',
];
