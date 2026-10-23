<?php
declare(strict_types=1);

return [
    'title' => 'The Number of Ways to Make the Sum: unlimited 1/2/6, at most two 4s',
    'leetcode' => 3183,
    'difficulty' => 'Med',
    'summary' => 'Count combinations with coins 1, 2, 6 (coin-change DP, coin by coin). Then add the 4s: answer = dp[n] + dp[n − 4] + dp[n − 8].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'the-number-of-ways-to-make-the-sum',
    'related_session' => 'the-number-of-ways-to-make-the-sum',
];
