<?php
declare(strict_types=1);

return [
    'title' => 'Delete Node in a BST: find it, then splice by number of children',
    'leetcode' => 450,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: delete key from a BST and return the root. Recurse by comparison. At the node: no left → return right; no right → return left; two children → copy the inorder successor (smallest on the right) and delete it from the right subtree. [5,3,6,2,4,null,7], 3 → [5,4,6,2,null,null,7]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'bst', 'recursion', 'step-by-step'],
    'related_guide' => 'delete-node-in-a-bst',
];
