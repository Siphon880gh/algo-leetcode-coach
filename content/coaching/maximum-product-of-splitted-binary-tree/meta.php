<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Splitted Binary Tree: cut at a subtree',
    'leetcode' => 1339,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: find the total, compute every subtree sum s in post-order, maximize s · (total − s), and only then apply the modulo. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'maximum-product-of-splitted-binary-tree',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
