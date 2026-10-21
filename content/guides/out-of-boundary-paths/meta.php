<?php
declare(strict_types=1);

return [
    'title' => 'Out of Boundary Paths: count ways by moves left',
    'leetcode' => 576,
    'difficulty' => 'Med',
    'summary' => 'DP over moves: f[k][i][j] counts the ways to stand on (i, j) after k moves. Every step that leaves the grid adds those ways to the answer, modulo 1e9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'memoization', 'leetcode'],
    'related_session' => 'out-of-boundary-paths',
];
