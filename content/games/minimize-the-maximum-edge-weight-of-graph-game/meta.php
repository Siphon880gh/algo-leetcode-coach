<?php
declare(strict_types=1);

return [
    'title' => 'Minimize the Maximum Edge Weight',
    'leetcode' => 3419,
    'difficulty' => 'Med',
    'summary' => 'Reverse the edges: node 0 must reach everyone. A BFS tree uses at most one outgoing edge per node, so the threshold never binds. Binary search the max weight W (or use a Dijkstra on bottleneck weights).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimize-the-maximum-edge-weight-of-graph',
    'related_session' => 'minimize-the-maximum-edge-weight-of-graph',
];
