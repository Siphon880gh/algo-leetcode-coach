<?php
declare(strict_types=1);

return [
    'title' => 'Inorder Successor in BST II: leftmost of the right subtree, else climb parents',
    'leetcode' => 510,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: inorder successor with parent pointers and no root. Right child: go right, then left to the end. Otherwise climb while the node is its parent\'s right child; return the parent (or null). Not 285. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'binary-search-tree', 'step-by-step'],
    'related_guide' => 'inorder-successor-in-bst-ii',
];
