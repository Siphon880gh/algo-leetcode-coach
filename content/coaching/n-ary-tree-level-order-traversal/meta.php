<?php
declare(strict_types=1);

return [
    'title' => 'N-ary Tree Level Order Traversal: BFS one level at a time, extend all children',
    'leetcode' => 429,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: return N-ary tree values grouped by level, left to right. BFS: freeze the queue length k, pop k nodes, record their values, and enqueue every child of each. [1,null,3,2,4,null,5,6] → [[1],[3,2,4],[5,6]]. Not 102 / 589. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bfs', 'n-ary-tree', 'step-by-step'],
    'related_guide' => 'n-ary-tree-level-order-traversal',
];
