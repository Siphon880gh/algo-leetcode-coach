<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Cycle in a Graph: BFS from every vertex',
    'leetcode' => 2608,
    'difficulty' => 'Hard',
    'summary' => 'Run a BFS from each vertex. When an edge reaches an already visited vertex that is not the parent, a cycle of length dist[u] + dist[v] + 1 passes near the start; the minimum over all starts is the girth.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'graph', 'leetcode'],
    'related_session' => 'shortest-cycle-in-a-graph',
];
