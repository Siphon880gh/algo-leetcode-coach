<?php
declare(strict_types=1);

return [
    'title' => 'Kill Process: children map, then a traversal',
    'leetcode' => 582,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build parent → children once, then BFS or DFS from kill and collect every pid. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'related_guide' => 'kill-process',
    'tags' => ['trees', 'bfs', 'dfs', 'hash-table', 'step-by-step'],
];
