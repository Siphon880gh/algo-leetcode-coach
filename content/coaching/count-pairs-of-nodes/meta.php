<?php
declare(strict_types=1);

return [
    'title' => 'Count Pairs Of Nodes: sorted degrees minus shared-edge corrections',
    'leetcode' => 1782,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: count pairs with deg[a] + deg[b] > q by two pointers on sorted degrees, then subtract connected pairs whose true incident count deg[a] + deg[b] − shared ≤ q. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'count-pairs-of-nodes',
    'tags' => ['two-pointers', 'graph', 'sorting', 'step-by-step'],
];
