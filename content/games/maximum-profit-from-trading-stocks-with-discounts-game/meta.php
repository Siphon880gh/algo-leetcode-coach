<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit from Trading Stocks with Discounts',
    'leetcode' => 3562,
    'difficulty' => 'Hard',
    'summary' => 'Tree knapsack. For each employee and "did my boss buy?" keep best[b] = max profit spending ≤ b in that subtree. Not buying: merge children with boss-bought = false. Buying (full price, or half if the boss bought): merge children with boss-bought = true.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-profit-from-trading-stocks-with-discounts',
    'related_session' => 'maximum-profit-from-trading-stocks-with-discounts',
];
