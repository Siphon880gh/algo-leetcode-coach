<?php
declare(strict_types=1);

return [
    'title' => 'Count Square Submatrices with All Ones: sum the DP',
    'leetcode' => 1277,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: dp[i][j] = 1 + min(top, left, top-left) for each 1, which is both the largest square side and the number of squares ending there, and sum it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-square-submatrices-with-all-ones',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
