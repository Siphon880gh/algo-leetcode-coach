<?php
declare(strict_types=1);

return [
    'title' => 'Escape a Large Maze: BFS with a cap on area',
    'leetcode' => 1036,
    'difficulty' => 'Hard',
    'summary' => 'At most 200 blocked cells can enclose at most about 200 · 199 / 2 cells. BFS from the source and from the target; each side is free if it reaches the other or visits more cells than that bound.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'hash-table', 'leetcode'],
    'related_session' => 'escape-a-large-maze',
];
