<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path Visiting All Nodes: BFS over (node, visited mask)',
    'leetcode' => 847,
    'difficulty' => 'Hard',
    'summary' => 'The state is where you stand and which nodes you have seen. BFS from every node at once (mask with just that node) over states (u, mask); the first state whose mask covers all nodes gives the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'bitmask', 'dynamic-programming', 'leetcode'],
    'related_session' => 'shortest-path-visiting-all-nodes',
];
