<?php
declare(strict_types=1);

return [
    'title' => 'Distance to a Cycle in Undirected Graph: peel leaves, then BFS',
    'leetcode' => 2204,
    'difficulty' => 'Hard',
    'summary' => 'Repeatedly remove leaves (degree 1); what remains is exactly the cycle. Then run a multi-source BFS from all cycle nodes to get every distance.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'distance-to-a-cycle-in-undirected-graph',
];
