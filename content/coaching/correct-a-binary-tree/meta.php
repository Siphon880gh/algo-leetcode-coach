<?php
declare(strict_types=1);

return [
    'title' => 'Correct a Binary Tree: seen-to-the-right test',
    'leetcode' => 1660,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: BFS each level right to left with a seen set; a node whose right child is already seen is defective; detach it from its parent. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'related_guide' => 'correct-a-binary-tree',
    'tags' => ['breadth-first-search', 'binary-tree', 'hash-set', 'step-by-step'],
];
