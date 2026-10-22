<?php
declare(strict_types=1);

return [
    'title' => 'Find the Safest Path in a Grid: one BFS, then a max-heap',
    'leetcode' => 2812,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: get all distances from one multi-source BFS, then always expand the safest cell first. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'find-the-safest-path-in-a-grid',
    'tags' => ['array', 'binary-search', 'breadth-first-search', 'union-find', 'heap', 'matrix', 'step-by-step'],
];
