<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Buy Apples: one Dijkstra from every city at once',
    'leetcode' => 2473,
    'difficulty' => 'Med',
    'summary' => 'Going to city c and back costs (1 + k) times the shortest distance, plus c’s price. Start a Dijkstra with every city’s price as its initial distance and edge weights scaled by 1 + k; the final distances are the answers.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'graph', 'heap', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-cost-to-buy-apples',
];
