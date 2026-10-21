<?php
declare(strict_types=1);

return [
    'title' => 'Checking Existence of Edge Length Limited Paths II: online queries on an MST',
    'leetcode' => 1724,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort edges and run Kruskal with union by rank and no path compression, storing the weight that joined each node to its parent; a query climbs from p and q only along links with weight < limit and checks if they reach the same top. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'checking-existence-of-edge-length-limited-paths-ii',
    'tags' => ['union-find', 'minimum-spanning-tree', 'graph', 'step-by-step'],
];
