<?php
declare(strict_types=1);

return [
    'title' => 'Number of Orders in the Backlog',
    'leetcode' => 1801,
    'difficulty' => 'Med',
    'summary' => 'Keep buy orders in a max-heap and sell orders in a min-heap by price. A buy matches the cheapest sells at most its price; a sell matches the highest buys at least its price. Leftovers go into the backlog; sum remaining amounts mod 1e9+7.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'tags' => ['heap', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-orders-in-the-backlog',
    'related_session' => 'number-of-orders-in-the-backlog',
];
