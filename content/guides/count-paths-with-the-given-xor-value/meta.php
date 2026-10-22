<?php
declare(strict_types=1);

return [
    'title' => 'Count Paths With the Given XOR Value: DP over cells and XOR',
    'leetcode' => 3393,
    'difficulty' => 'Med',
    'summary' => 'Values are below 16, so every path XOR is below 16. dp[i][j][x] = paths from (0, 0) to (i, j) with XOR x; each cell takes from above and from the left.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'count-paths-with-the-given-xor-value',
];
