<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Falling Path Sum: row-by-row DP',
    'leetcode' => 931,
    'difficulty' => 'Med',
    'summary' => 'The best path to a cell comes from one of the three cells above it. Fill row by row with dp[j] = matrix[i][j] + min of the up-to-three neighbors in the previous row, and return the smallest value in the last row.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimum-falling-path-sum',
];
