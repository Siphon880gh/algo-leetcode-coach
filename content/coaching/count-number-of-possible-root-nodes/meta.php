<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Possible Root Nodes: lose (u, v), gain (v, u), count ≥ k',
    'leetcode' => 2581,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: moving the root to child v loses guess (u, v) and gains (v, u), and a root counts when it reaches k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'count-number-of-possible-root-nodes',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'tree', 'depth-first-search', 'step-by-step'],
];
