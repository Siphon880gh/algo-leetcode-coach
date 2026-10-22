<?php
declare(strict_types=1);

return [
    'title' => 'Coin Change: 1 + best smaller amount',
    'leetcode' => 322,
    'difficulty' => 'Med',
    'summary' => 'dp[a] = 1 + min over coins c ≤ a of dp[a − c]. dp[0] = 0. If no coin leads to a reachable amount, dp[a] = ∞ (answer −1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'coin-change',
    'related_session' => 'coin-change',
];
