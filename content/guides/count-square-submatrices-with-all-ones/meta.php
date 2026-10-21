<?php
declare(strict_types=1);

return [
    'title' => 'Count Square Submatrices with All Ones: largest square per corner',
    'leetcode' => 1277,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] is the side of the largest all-ones square with bottom-right corner (i, j), equal to 1 + min(top, left, top-left). That cell is also the corner of exactly dp[i][j] squares, so sum all values.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'count-square-submatrices-with-all-ones',
];
