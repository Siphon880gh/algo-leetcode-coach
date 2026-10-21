<?php
declare(strict_types=1);

return [
    'title' => 'Number of Closed Islands: sink border land first',
    'leetcode' => 1254,
    'difficulty' => 'Med',
    'summary' => 'Here 0 is land and 1 is water. Flood-fill every land cell connected to the border, since those islands are not closed, then count the remaining land components.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'dfs', 'bfs', 'matrix', 'leetcode'],
    'related_session' => 'number-of-closed-islands',
];
