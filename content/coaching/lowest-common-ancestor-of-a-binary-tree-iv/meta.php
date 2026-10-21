<?php
declare(strict_types=1);

return [
    'title' => 'LCA IV: target set in one post-order',
    'leetcode' => 1676,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: put targets in a set; post-order returns a node if it is a target, the node if both sides return non-null, else the non-null side. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'lowest-common-ancestor-of-a-binary-tree-iv',
    'tags' => ['depth-first-search', 'binary-tree', 'hash-set', 'step-by-step'],
];
