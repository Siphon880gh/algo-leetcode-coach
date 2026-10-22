<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Visited Cells in a Grid: BFS that removes visited cells',
    'leetcode' => 2617,
    'difficulty' => 'Hard',
    'summary' => 'A BFS from the top-left gives the fewest cells, but scanning every reachable cell is too slow. Keep the unvisited cells of each row and each column in a next-pointer structure, so each cell is taken off once.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'breadth-first-search', 'union-find', 'matrix', 'heap', 'leetcode'],
    'related_session' => 'minimum-number-of-visited-cells-in-a-grid',
];
