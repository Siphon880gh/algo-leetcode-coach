<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit from Trading Stocks with Discounts: tree knapsack',
    'leetcode' => 3562,
    'difficulty' => 'Hard',
    'summary' => 'For each employee and whether the direct boss bought, keep best[cost] for the subtree. Not buying passes "boss did not buy" to the children; buying pays the (possibly halved) price and passes "boss bought". Merge children as knapsacks.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-profit-from-trading-stocks-with-discounts',
];
