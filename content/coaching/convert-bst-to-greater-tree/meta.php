<?php
declare(strict_types=1);

return [
    'title' => 'Convert BST to Greater Tree: reverse inorder with a running sum',
    'leetcode' => 538,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: replace each BST value with itself plus all larger values. Reverse inorder (right, node, left) with a running sum s: s += val; val = s. [0,null,1] → [1,null,1]. Same as 1038. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'binary-search-tree', 'dfs', 'step-by-step'],
    'related_guide' => 'convert-bst-to-greater-tree',
];
