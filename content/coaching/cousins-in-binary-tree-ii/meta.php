<?php
declare(strict_types=1);

return [
    'title' => 'Cousins in Binary Tree II: subtract the siblings, zero the root',
    'leetcode' => 2641,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each child gets the next level’s total minus its own and its sibling’s values, and the root becomes 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'cousins-in-binary-tree-ii',
    'tags' => ['hash-table', 'tree', 'depth-first-search', 'breadth-first-search', 'binary-tree', 'step-by-step'],
];
