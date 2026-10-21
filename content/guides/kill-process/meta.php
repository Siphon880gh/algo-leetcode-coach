<?php
declare(strict_types=1);

return [
    'title' => 'Kill Process: walk the children from the killed process',
    'leetcode' => 582,
    'difficulty' => 'Med',
    'summary' => 'Build a map from each parent pid to its children, then BFS or DFS from kill and collect every pid you reach.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'bfs', 'dfs', 'hash-table', 'leetcode'],
    'related_session' => 'kill-process',
];
