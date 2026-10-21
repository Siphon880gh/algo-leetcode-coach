<?php
declare(strict_types=1);

return [
    'title' => 'Clone Binary Tree With Random Pointer: memoised DFS',
    'leetcode' => 1485,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS with a map from original to copy, storing each copy before recursing into left, right, and random. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'clone-binary-tree-with-random-pointer',
    'tags' => ['tree', 'dfs', 'hash-map', 'step-by-step'],
];
