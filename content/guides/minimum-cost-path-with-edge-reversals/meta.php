<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Edge Reversals: Dijkstra with doubled reverse edges',
    'leetcode' => 3650,
    'difficulty' => 'Med',
    'summary' => 'Add each edge v → u a second time as u → v with cost 2w. A shortest path never visits a node twice, so each switch is used at most once anyway; run Dijkstra.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'minimum-cost-path-with-edge-reversals',
];
