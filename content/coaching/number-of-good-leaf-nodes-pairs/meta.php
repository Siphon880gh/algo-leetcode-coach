<?php
declare(strict_types=1);

return [
    'title' => 'Good Leaf Node Pairs: depth histograms',
    'leetcode' => 1530,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS returns leaf counts by depth (≤ distance); at each node pair left depth i with right depth j where i + j ≤ distance; shift by 1 upward. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'number-of-good-leaf-nodes-pairs',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
