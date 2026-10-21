<?php
declare(strict_types=1);

return [
    'title' => 'Design Most Recently Used Queue: Fenwick tree over slots',
    'leetcode' => 1756,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: give each element a slot, keep live counts in a Fenwick tree, find the k-th live slot by binary lifting, clear it and append the value to a fresh slot. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Design',
    'topic' => 'LeetCode · Design',
    'related_guide' => 'design-most-recently-used-queue',
    'tags' => ['design', 'binary-indexed-tree', 'queue', 'step-by-step'],
];
