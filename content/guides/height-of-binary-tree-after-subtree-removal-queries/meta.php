<?php
declare(strict_types=1);

return [
    'title' => 'Height of Binary Tree After Subtree Removal Queries: Euler tour, prefix and suffix maxima',
    'leetcode' => 2458,
    'difficulty' => 'Hard',
    'summary' => 'A DFS lays every subtree out as one contiguous block of visit order. Removing a subtree leaves the nodes before and after its block, so the new height is the larger of a prefix maximum and a suffix maximum of depths.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'depth-first-search', 'breadth-first-search', 'binary-tree', 'leetcode'],
    'related_session' => 'height-of-binary-tree-after-subtree-removal-queries',
];
