<?php
declare(strict_types=1);

return [
    'title' => 'The Maze: graph search where a move rolls until a wall',
    'leetcode' => 490,
    'difficulty' => 'Med',
    'summary' => 'A ball rolls in one direction until it hits a wall, then may pick a new direction. Can it stop at destination? Nodes are stopping cells; from each, roll in 4 directions to find the next stopping cells. BFS or DFS with a visited set; true when you stop at destination (passing through does not count). Example 1 → true. Not 505 / 499.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'dfs', 'matrix', 'leetcode'],
    'related_session' => 'the-maze',
];
