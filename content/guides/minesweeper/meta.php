<?php
declare(strict_types=1);

return [
    'title' => 'Minesweeper: reveal with DFS, stop at numbered cells',
    'leetcode' => 529,
    'difficulty' => 'Med',
    'summary' => 'Apply one click. A mine (M) becomes X. An empty square (E) counts adjacent mines among 8 neighbors: if the count is positive, write the digit and stop; if zero, write B and reveal every adjacent E recursively (DFS or BFS). Only E cells are expanded.',
    'category' => 'LeetCode',
    'subcategory' => 'Depth-First Search',
    'topic' => 'LeetCode · Depth-First Search',
    'kind' => 'algo',
    'tags' => ['dfs', 'bfs', 'matrix', 'simulation', 'leetcode'],
    'related_session' => 'minesweeper',
];
