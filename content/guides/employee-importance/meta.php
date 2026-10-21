<?php
declare(strict_types=1);

return [
    'title' => 'Employee Importance: index by id, then sum the subtree',
    'leetcode' => 690,
    'difficulty' => 'Med',
    'summary' => 'Map ids to employees, then DFS or BFS from the given id, adding the importance of everyone reachable through the subordinates lists.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'bfs', 'hash-map', 'leetcode'],
    'related_session' => 'employee-importance',
];
