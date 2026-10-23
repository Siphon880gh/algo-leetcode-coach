<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Distinct Path Sum in a Binary Tree: search from every node',
    'leetcode' => 3879,
    'difficulty' => 'Med',
    'summary' => 'Treat the tree as an undirected graph. From each node, DFS along simple paths, skipping any node whose value is already on the path, and keep the best sum where a path may stop anywhere.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'hash-table', 'binary-tree', 'leetcode'],
    'related_session' => 'maximum-distinct-path-sum-in-a-binary-tree',
];
