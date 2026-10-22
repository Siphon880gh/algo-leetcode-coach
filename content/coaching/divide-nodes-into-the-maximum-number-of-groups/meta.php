<?php
declare(strict_types=1);

return [
    'title' => 'Divide Nodes Into the Maximum Number of Groups: an odd cycle means −1, BFS from every node',
    'leetcode' => 2493,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: return −1 when an edge joins two nodes in the same BFS level, and try every node as the start, not one per component. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'divide-nodes-into-the-maximum-number-of-groups',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'step-by-step'],
];
