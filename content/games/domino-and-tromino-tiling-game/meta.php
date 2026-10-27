<?php
declare(strict_types=1);

return [
    'title' => 'Domino and Tromino Tiling: dp[n] = 2 times dp[n−1] + dp[n−3]',
    'leetcode' => 790,
    'difficulty' => 'Med',
    'summary' => 'Counting full boards: dp[0] = 1, dp[1] = 1, dp[2] = 2, then dp[i] = 2 times dp[i−1] + dp[i−3] (from summing the partial-board states).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'domino-and-tromino-tiling',
    'related_session' => 'domino-and-tromino-tiling',
];
