<?php
declare(strict_types=1);

return [
    'title' => 'Checking Existence of Edge Length Limited Paths II: online queries on an MST',
    'leetcode' => 1724,
    'difficulty' => 'Hard',
    'summary' => 'Only the minimum spanning forest matters: a path with all edges < limit exists iff the max edge on the MST path is < limit. Build a Kruskal DSU that records each union\'s weight (union by rank, no path compression) and climb parent links while the recorded weight is < limit.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'minimum-spanning-tree', 'graph', 'leetcode'],
    'related_session' => 'checking-existence-of-edge-length-limited-paths-ii',
];
