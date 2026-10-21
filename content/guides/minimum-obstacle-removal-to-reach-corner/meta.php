<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Obstacle Removal to Reach Corner: 0-1 BFS',
    'leetcode' => 2290,
    'difficulty' => 'Hard',
    'summary' => 'Treat stepping onto a cell as costing its value, 0 or 1. Run a 0-1 BFS with a deque: push 0-cost moves to the front and 1-cost moves to the back; the distance at the corner is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['array', 'breadth-first-search', 'graph', 'heap', 'matrix', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-obstacle-removal-to-reach-corner',
];
