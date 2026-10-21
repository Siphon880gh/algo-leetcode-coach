<?php
declare(strict_types=1);

return [
    'title' => 'Construct Binary Tree from Preorder and Postorder: split by the left size',
    'leetcode' => 889,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pre[0] is the root, pre[1] is the left root, and its position in postorder gives the left subtree size that splits both arrays. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'construct-binary-tree-from-preorder-and-postorder-traversal',
    'tags' => ['trees', 'divide-and-conquer', 'hash-table', 'step-by-step'],
];
