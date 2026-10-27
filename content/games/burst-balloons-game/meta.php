<?php
declare(strict_types=1);

return [
    'title' => 'Burst Balloons: choose the LAST balloon in each interval',
    'leetcode' => 312,
    'difficulty' => 'Hard',
    'summary' => 'Pad with 1s. dp[l][r] = best coins bursting everything strictly between l and r. Try each k as the last one: dp[l][k] + dp[k][r] + v[l] times v[k] times v[r].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'burst-balloons',
    'related_session' => 'burst-balloons',
];
