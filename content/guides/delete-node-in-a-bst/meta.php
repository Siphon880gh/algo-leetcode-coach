<?php
declare(strict_types=1);

return [
    'title' => 'Delete Node in a BST: find it, then splice by number of children',
    'leetcode' => 450,
    'difficulty' => 'Med',
    'summary' => 'Delete key from a BST and return the root. Recurse left or right by comparison. At the node: no left child → return right; no right child → return left; two children → replace with the inorder successor (smallest in the right subtree) and delete that successor. [5,3,6,2,4,null,7], 3 → [5,4,6,2,null,null,7]. Not 701.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bst', 'recursion', 'leetcode'],
    'related_session' => 'delete-node-in-a-bst',
];
