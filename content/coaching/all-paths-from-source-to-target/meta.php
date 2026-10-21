<?php
declare(strict_types=1);

return [
    'title' => 'All Paths From Source to Target: backtrack on a DAG',
    'leetcode' => 797,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: DFS from 0 with the current path, save a copy at n − 1, and pop after each neighbor; no visited set is needed. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'all-paths-from-source-to-target',
    'tags' => ['graphs', 'dfs', 'backtracking', 'step-by-step'],
];
