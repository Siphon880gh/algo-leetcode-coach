<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum BST in Binary Tree: (isBST, min, max, sum)',
    'leetcode' => 1373,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: return validity, min, max, and sum from each subtree; a node is a BST when both children are and left max < val < right min; track the best sum from 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'maximum-sum-bst-in-binary-tree',
    'tags' => ['tree', 'bst', 'dfs', 'step-by-step'],
];
