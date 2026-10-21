<?php
declare(strict_types=1);

return [
    'title' => 'Pacific Atlantic Water Flow: reverse BFS uphill from both oceans',
    'leetcode' => 417,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: find cells that drain to both oceans. Pacific is top and left; Atlantic is bottom and right. Water flows to a neighbor of height less than or equal. Search inland from each ocean border (neighbor height greater or equal), then intersect. [[1]] → [[0,0]]. Not 200 / 130. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graphs', 'bfs', 'dfs', 'matrix', 'step-by-step'],
    'related_guide' => 'pacific-atlantic-water-flow',
];
