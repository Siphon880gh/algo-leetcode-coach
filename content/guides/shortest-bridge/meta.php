<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Bridge: mark one island, BFS outward',
    'leetcode' => 934,
    'difficulty' => 'Med',
    'summary' => 'Find one island with DFS and put all its cells in a queue. Then BFS across the water from all of them at once; the first time you touch a cell of the other island, the BFS level is the number of flips.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bfs', 'depth-first-search', 'matrix', 'leetcode'],
    'related_session' => 'shortest-bridge',
];
