<?php
declare(strict_types=1);

return [
    'title' => 'Subtree of Another Tree: same tree, tried at every node',
    'leetcode' => 572,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: compare whole trees with a sameTree helper, keep searching the children on a mismatch, or serialize with null markers and run KMP. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'subtree-of-another-tree',
    'tags' => ['trees', 'dfs', 'binary-tree', 'string-matching', 'step-by-step'],
];
