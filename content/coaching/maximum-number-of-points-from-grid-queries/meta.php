<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Points From Grid Queries: strictly smaller cells, one sweep',
    'leetcode' => 2503,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: pop only cells strictly smaller than the query, and answer queries in sorted order on one growing region. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'maximum-number-of-points-from-grid-queries',
    'tags' => ['array', 'two-pointers', 'breadth-first-search', 'union-find', 'sorting', 'heap', 'matrix', 'step-by-step'],
];
