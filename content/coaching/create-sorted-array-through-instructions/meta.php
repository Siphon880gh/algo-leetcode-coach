<?php
declare(strict_types=1);

return [
    'title' => 'Create Sorted Array: Fenwick tree counts',
    'leetcode' => 1649,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: before inserting x, count less = query(x − 1) and greater = inserted − query(x); add min; update. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'related_guide' => 'create-sorted-array-through-instructions',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'step-by-step'],
];
