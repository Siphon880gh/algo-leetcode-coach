<?php
declare(strict_types=1);

return [
    'title' => '01 Matrix: multi-source BFS from every 0',
    'leetcode' => 542,
    'difficulty' => 'Med',
    'summary' => 'Distance from each cell to its nearest 0 (4-directional). Push all 0 cells into a queue at distance 0, mark 1 cells unknown, and BFS: each popped cell sets unknown neighbors to its distance + 1. Each cell is set once. Or two DP passes (top-left, then bottom-right). [[0,0,0],[0,1,0],[1,1,1]] → [[0,0,0],[0,1,0],[1,2,1]].',
    'category' => 'LeetCode',
    'subcategory' => 'BFS',
    'topic' => 'LeetCode · BFS',
    'kind' => 'algo',
    'tags' => ['bfs', 'matrix', 'dynamic-programming', 'leetcode'],
    'related_session' => '01-matrix',
];
