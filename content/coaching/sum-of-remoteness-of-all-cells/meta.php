<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Remoteness of All Cells: one fill per component, weight by size',
    'leetcode' => 2852,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: flood fill each component once, and multiply its outside sum by its size. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'sum-of-remoteness-of-all-cells',
    'tags' => ['array', 'hash-table', 'depth-first-search', 'breadth-first-search', 'union-find', 'matrix', 'step-by-step'],
];
