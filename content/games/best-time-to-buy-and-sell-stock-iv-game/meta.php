<?php
declare(strict_types=1);

return [
    'title' => 'Stock IV: one buy/sell state pair per allowed transaction',
    'leetcode' => 188,
    'difficulty' => 'Hard',
    'summary' => 'For t = 1..k: buy[t] = max(buy[t], sell[t−1] − p) and sell[t] = max(sell[t], buy[t] + p). The answer is sell[k].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-time-to-buy-and-sell-stock-iv',
    'related_session' => 'best-time-to-buy-and-sell-stock-iv',
];
