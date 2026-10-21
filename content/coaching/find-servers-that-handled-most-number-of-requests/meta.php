<?php
declare(strict_types=1);

return [
    'title' => 'Busiest Servers: sorted free set plus busy heap',
    'leetcode' => 1606,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: release finished servers from a heap, then pick the first free server ≥ i mod k (wrapping) from a sorted set; drop the request if none. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'find-servers-that-handled-most-number-of-requests',
    'tags' => ['heap', 'ordered-set', 'simulation', 'step-by-step'],
];
