<?php
declare(strict_types=1);

return [
    'title' => 'Construct BST from Preorder Traversal: recurse with an upper bound',
    'leetcode' => 1008,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: consume preorder with one index; a call with bound b builds a node only while the next value is below b, giving its left subtree bound node.val and its right subtree bound b. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'construct-binary-search-tree-from-preorder-traversal',
    'tags' => ['trees', 'binary-search-tree', 'stack', 'recursion', 'step-by-step'],
];
