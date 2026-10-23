<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Cycle in a Graph',
    'leetcode' => 2608,
    'difficulty' => 'Hard',
    'summary' => 'BFS from every vertex. When an edge reaches an already-visited vertex that is not the parent, a cycle of length d[u] + d[v] + 1 exists. The smallest over all starts is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'shortest-cycle-in-a-graph',
    'related_session' => 'shortest-cycle-in-a-graph',
];
