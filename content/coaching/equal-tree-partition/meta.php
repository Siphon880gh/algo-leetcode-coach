<?php
declare(strict_types=1);

return [
    'title' => 'Equal Tree Partition: look for half the total among subtree sums',
    'leetcode' => 663,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: collect every subtree sum except the whole tree\'s, then look for total / 2 among them. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'equal-tree-partition',
    'tags' => ['trees', 'dfs', 'hash-table', 'binary-tree', 'step-by-step'],
];
