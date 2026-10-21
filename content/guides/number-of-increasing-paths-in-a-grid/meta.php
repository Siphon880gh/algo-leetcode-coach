<?php
declare(strict_types=1);

return [
    'title' => 'Number of Increasing Paths in a Grid: count paths from each cell',
    'leetcode' => 2328,
    'difficulty' => 'Hard',
    'summary' => 'dp[c] = number of strictly increasing paths starting at c = 1 + the sum of dp over larger neighbours. Process cells from largest value to smallest (or memoised DFS) and sum all dp modulo 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'depth-first-search', 'breadth-first-search', 'graph', 'topological-sort', 'memoization', 'matrix', 'leetcode'],
    'related_session' => 'number-of-increasing-paths-in-a-grid',
];
