<?php
declare(strict_types=1);

return [
    'title' => 'The Maze: graph search where a move rolls until a wall',
    'leetcode' => 490,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: can a rolling ball stop at the destination? Nodes are stopping cells. From each stop, roll each direction until the next cell is a wall. BFS or DFS with visited; passing through the destination does not count. Not 505 / 499. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['bfs', 'dfs', 'graphs', 'matrix', 'step-by-step'],
    'related_guide' => 'the-maze',
];
