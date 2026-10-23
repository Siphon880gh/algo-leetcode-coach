<?php
declare(strict_types=1);

return [
    'title' => 'Toss Strange Coins: probability of j heads so far',
    'leetcode' => 1230,
    'difficulty' => 'Med',
    'summary' => 'dp[j] = probability of exactly j heads so far. Each coin p: new[j] = dp[j]·(1 − p) + dp[j − 1]·p.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'toss-strange-coins',
    'related_session' => 'toss-strange-coins',
];
