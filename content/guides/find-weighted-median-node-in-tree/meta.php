<?php
declare(strict_types=1);

return [
    'title' => 'Find Weighted Median Node in Tree: binary lifting on weighted depth',
    'leetcode' => 3585,
    'difficulty' => 'Hard',
    'summary' => 'Total = d(u, v) via LCA. If the climb from u to the LCA already reaches half, lift u to the first ancestor x with 2 · dist(u, x) ≥ total. Otherwise the median is on the v side: lift v to the highest ancestor still satisfying the bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['tree', 'depth-first-search', 'array', 'binary-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'find-weighted-median-node-in-tree',
];
