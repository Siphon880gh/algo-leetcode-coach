<?php
declare(strict_types=1);

return [
    'title' => '01 Matrix: multi-source BFS from every 0',
    'leetcode' => 542,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: distance from each cell to its nearest 0. Multi-source BFS: start with all zeros at distance 0, mark ones unknown, and set neighbors to d + 1 the first time they are reached. Or two DP sweeps. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'BFS',
    'topic' => 'LeetCode · BFS',
    'tags' => ['bfs', 'matrix', 'dynamic-programming', 'step-by-step'],
    'related_guide' => '01-matrix',
];
