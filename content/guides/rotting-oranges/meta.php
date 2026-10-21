<?php
declare(strict_types=1);

return [
    'title' => 'Rotting Oranges: multi-source BFS by minutes',
    'leetcode' => 994,
    'difficulty' => 'Med',
    'summary' => 'Put every rotten orange in the queue at minute 0 and count the fresh ones. BFS level by level; each level is one minute and rots adjacent fresh oranges. If any fresh orange is left, return −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bfs', 'matrix', 'graphs', 'leetcode'],
    'related_session' => 'rotting-oranges',
];
