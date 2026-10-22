<?php
declare(strict_types=1);

return [
    'title' => 'Minimize Trip Prices: count over all trips, children stay full under a halved node',
    'leetcode' => 2646,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: choose one halving set for all trips using visit counts, and under a halved node keep children at full price. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'minimize-the-total-price-of-the-trips',
    'tags' => ['array', 'dynamic-programming', 'tree', 'depth-first-search', 'graph', 'step-by-step'],
];
