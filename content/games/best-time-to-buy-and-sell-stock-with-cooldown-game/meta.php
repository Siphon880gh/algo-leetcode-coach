<?php
declare(strict_types=1);

return [
    'title' => 'Stock with Cooldown: hold, just sold, or resting',
    'leetcode' => 309,
    'difficulty' => 'Med',
    'summary' => 'hold = max(hold, rest − p); sold = hold_prev + p; rest = max(rest, sold_prev). You may only buy from rest, which forces the one-day cooldown.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-time-to-buy-and-sell-stock-with-cooldown',
    'related_session' => 'best-time-to-buy-and-sell-stock-with-cooldown',
];
