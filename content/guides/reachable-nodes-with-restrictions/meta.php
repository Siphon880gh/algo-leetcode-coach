<?php
declare(strict_types=1);

return [
    'title' => 'Reachable Nodes With Restrictions: search that never enters restricted nodes',
    'leetcode' => 2368,
    'difficulty' => 'Med',
    'summary' => 'Build the adjacency list, mark restricted nodes as blocked, and run a DFS or BFS from node 0 that never steps onto a blocked node. The answer is the number of nodes it visits.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'tree', 'depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'reachable-nodes-with-restrictions',
];
