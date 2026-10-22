<?php
declare(strict_types=1);

return [
    'title' => 'Is Array a Preorder of Some Binary Tree: the parent must be on the path',
    'leetcode' => 2764,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pop the stack until the parent is on top, and fail when the stack runs out. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Stack',
    'topic' => 'LeetCode · Stack',
    'related_guide' => 'is-array-a-preorder-of-some-binary-tree',
    'tags' => ['stack', 'tree', 'depth-first-search', 'binary-tree', 'step-by-step'],
];
