<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Consistent Columns in a Grid: LIS-style DP',
    'leetcode' => 3989,
    'difficulty' => 'Hard',
    'summary' => 'dp[j] = most columns kept ending at column j. Column i can come right before j when every row differs by at most limit.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'maximum-consistent-columns-in-a-grid',
];
