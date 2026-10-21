<?php
declare(strict_types=1);

return [
    'title' => 'Min Cost to Connect All Points: dense Prim',
    'leetcode' => 1584,
    'difficulty' => 'Med',
    'summary' => 'The graph is complete with Manhattan weights, so O(n²) Prim without a heap is ideal: keep the cheapest distance from the tree to each point and add the closest point each round.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graph', 'mst', 'leetcode'],
    'related_session' => 'min-cost-to-connect-all-points',
];
