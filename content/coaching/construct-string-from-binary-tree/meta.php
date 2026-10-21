<?php
declare(strict_types=1);

return [
    'title' => 'Construct String from Binary Tree: only the parentheses you need',
    'leetcode' => 606,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: preorder with value, (left), (right); keep () only for a missing left child when a right child exists. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'construct-string-from-binary-tree',
    'tags' => ['trees', 'dfs', 'strings', 'binary-tree', 'step-by-step'],
];
