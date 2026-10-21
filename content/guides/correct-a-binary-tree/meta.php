<?php
declare(strict_types=1);

return [
    'title' => 'Correct a Binary Tree: right-to-left BFS',
    'leetcode' => 1660,
    'difficulty' => 'Med',
    'summary' => 'BFS each level from right to left, recording visited nodes. A node whose right child is already visited on this level is the defective one; detach it from its parent.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'kind' => 'algo',
    'tags' => ['breadth-first-search', 'binary-tree', 'hash-set', 'leetcode'],
    'related_session' => 'correct-a-binary-tree',
];
