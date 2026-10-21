<?php
declare(strict_types=1);

return [
    'title' => 'Kth Ancestor of a Tree Node: binary lifting',
    'leetcode' => 1483,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: build up[j][v] (2^j-th ancestor) from the parent array; answer by jumping along the bits of k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'kth-ancestor-of-a-tree-node',
    'tags' => ['tree', 'binary-lifting', 'dp', 'step-by-step'],
];
