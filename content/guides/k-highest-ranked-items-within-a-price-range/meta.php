<?php
declare(strict_types=1);

return [
    'title' => 'K Highest Ranked Items Within a Price Range: BFS then sort',
    'leetcode' => 2146,
    'difficulty' => 'Med',
    'summary' => 'BFS from start to get the distance of every reachable cell. Keep cells priced within [low, high] and sort by (distance, price, row, col); return the first k positions.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bfs', 'sorting', 'matrix', 'leetcode'],
    'related_session' => 'k-highest-ranked-items-within-a-price-range',
];
