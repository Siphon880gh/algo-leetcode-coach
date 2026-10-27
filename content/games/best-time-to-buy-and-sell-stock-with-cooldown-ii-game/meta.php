<?php
declare(strict_types=1);

return [
    'title' => 'Best Time to Buy and Sell Stock with Cooldown II',
    'leetcode' => 4069,
    'difficulty' => 'Med',
    'summary' => 'The fee depends on the holding length, so choose the buy day explicitly. F[j] = the best profit with every trade closed by day j = max(F[j − 1], max over i < j of F[i − cooldown − 1] + prices[j] − prices[i] − costs[j − i]), where F of a negative day is 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'best-time-to-buy-and-sell-stock-with-cooldown-ii',
    'related_session' => 'best-time-to-buy-and-sell-stock-with-cooldown-ii',
];
