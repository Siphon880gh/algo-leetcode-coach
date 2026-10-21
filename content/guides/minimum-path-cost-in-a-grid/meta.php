<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Path Cost in a Grid: row-by-row DP',
    'leetcode' => 2304,
    'difficulty' => 'Med',
    'summary' => 'dp over the current row: the cost to reach cell (r, j) is its value plus the cheapest dp[r − 1][i] + moveCost[grid[r − 1][i]][j]. The answer is the smallest entry of the last row.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimum-path-cost-in-a-grid',
];
