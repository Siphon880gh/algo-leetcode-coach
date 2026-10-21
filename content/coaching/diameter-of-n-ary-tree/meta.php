<?php
declare(strict_types=1);

return [
    'title' => 'Diameter of N-Ary Tree: top two heights',
    'leetcode' => 1522,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS returns height; at each node combine the two largest child heights + 1 each; track the best. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'diameter-of-n-ary-tree',
    'tags' => ['tree', 'dfs', 'step-by-step'],
];
