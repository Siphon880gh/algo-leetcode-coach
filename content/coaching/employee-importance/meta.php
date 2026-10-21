<?php
declare(strict_types=1);

return [
    'title' => 'Employee Importance: map ids, then sum the subtree',
    'leetcode' => 690,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: index employees by id, then DFS or BFS from the given id adding every reachable importance. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'employee-importance',
    'tags' => ['graphs', 'dfs', 'bfs', 'hash-map', 'step-by-step'],
];
