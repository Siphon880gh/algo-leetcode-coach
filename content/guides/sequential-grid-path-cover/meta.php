<?php
declare(strict_types=1);

return [
    'title' => 'Sequential Grid Path Cover: backtracking Hamiltonian path',
    'leetcode' => 3565,
    'difficulty' => 'Med',
    'summary' => 'Try every start cell that holds 0 or 1 and extend the path one neighbour at a time, only onto unvisited cells that are 0 or the next required number; succeed when all cells are used and every number was met.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['array', 'recursion', 'matrix', 'leetcode'],
    'related_session' => 'sequential-grid-path-cover',
];
