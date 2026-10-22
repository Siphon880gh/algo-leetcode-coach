<?php
declare(strict_types=1);

return [
    'title' => 'Extract Kth Character From The Rope Tree: subtract when going right',
    'leetcode' => 2689,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: going right skips the left part, so subtract its length, and at a leaf index with what is left of k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'extract-kth-character-from-the-rope-tree',
    'tags' => ['tree', 'depth-first-search', 'binary-tree', 'step-by-step'],
];
