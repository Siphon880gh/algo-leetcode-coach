<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Sort a Binary Tree by Level: cycles, not inversions',
    'leetcode' => 2471,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count swaps from the cycles of each level’s permutation rather than inversions, and charge a cycle of length L only L − 1 swaps. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'minimum-number-of-operations-to-sort-a-binary-tree-by-level',
    'tags' => ['tree', 'breadth-first-search', 'binary-tree', 'step-by-step'],
];
