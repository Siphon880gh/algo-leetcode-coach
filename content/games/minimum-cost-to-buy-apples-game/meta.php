<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Buy Apples',
    'leetcode' => 2473,
    'difficulty' => 'Med',
    'summary' => 'Going and returning use the same shortest path, so the trip to city j costs dist(i, j) times (k + 1) + appleCost[j]. Run Dijkstra (or one multi-source Dijkstra seeded with appleCost).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-buy-apples',
    'related_session' => 'minimum-cost-to-buy-apples',
];
