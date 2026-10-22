<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Moves in a Grid: column-by-column reachability',
    'leetcode' => 2684,
    'difficulty' => 'Med',
    'summary' => 'Start with every cell of the first column reachable. For each next column, a cell is reachable from a reachable neighbour one row up, level or down with a smaller value. The answer is the last column reached.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'maximum-number-of-moves-in-a-grid',
];
