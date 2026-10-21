<?php
declare(strict_types=1);

return [
    'title' => 'All Paths From Source to Target: DFS on a DAG',
    'leetcode' => 797,
    'difficulty' => 'Med',
    'summary' => 'The graph is a DAG, so DFS from node 0 can never loop. Keep the current path, record a copy when you reach n − 1, and backtrack after each neighbor.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'backtracking', 'leetcode'],
    'related_session' => 'all-paths-from-source-to-target',
];
