<?php
declare(strict_types=1);

return [
    'title' => 'Divide Nodes Into the Maximum Number of Groups: bipartite check, then the deepest BFS per component',
    'leetcode' => 2493,
    'difficulty' => 'Hard',
    'summary' => 'Groups act like BFS levels, so an odd cycle makes it impossible. In a bipartite component, BFS from every node and keep the most levels; components are independent, so add their bests.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'breadth-first-search', 'union-find', 'graph', 'leetcode'],
    'related_session' => 'divide-nodes-into-the-maximum-number-of-groups',
];
