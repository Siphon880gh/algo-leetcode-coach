<?php
declare(strict_types=1);

return [
    'title' => 'Range Sum of BST: prune with the order',
    'leetcode' => 938,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: a node below low only has candidates on its right, a node above high only on its left; otherwise add it and search both sides. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'range-sum-of-bst',
    'tags' => ['trees', 'binary-search-tree', 'depth-first-search', 'step-by-step'],
];
