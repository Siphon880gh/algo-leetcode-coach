<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Total Distance Traveled: sorted robots go to sorted factories in blocks',
    'leetcode' => 2463,
    'difficulty' => 'Hard',
    'summary' => 'Sort both. dp[i][j] = least distance fixing the first i robots with the first j factories = min over t at most limit_j of dp[i−t][j−1] + distance of robots i−t to i−1 to factory j.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-total-distance-traveled',
    'related_session' => 'minimum-total-distance-traveled',
];
