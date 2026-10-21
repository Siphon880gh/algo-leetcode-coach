<?php
declare(strict_types=1);

return [
    'title' => 'Validate Binary Tree Nodes: parents, root, reachability',
    'leetcode' => 1361,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: reject any node with two parents, require exactly one root, and BFS from it to check that all n nodes are reached. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'validate-binary-tree-nodes',
    'tags' => ['tree', 'graph', 'bfs', 'step-by-step'],
];
