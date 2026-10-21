<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Path Visiting All Nodes: BFS over (node, mask)',
    'leetcode' => 847,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the state is the current node plus the set of nodes seen; BFS from all nodes at once and stop at the first full mask. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'shortest-path-visiting-all-nodes',
    'tags' => ['graphs', 'bfs', 'bitmask', 'dynamic-programming', 'step-by-step'],
];
