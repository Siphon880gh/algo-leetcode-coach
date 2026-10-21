<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Absolute Difference in BST: inorder, compare neighbors',
    'leetcode' => 530,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: minimum difference between any two BST values. Inorder visits sorted values; the closest pair is adjacent. Track prev and the best gap. [4,2,6,1,3] → 1. Same as 783. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['trees', 'binary-search-tree', 'dfs', 'step-by-step'],
    'related_guide' => 'minimum-absolute-difference-in-bst',
];
