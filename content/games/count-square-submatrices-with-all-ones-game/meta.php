<?php
declare(strict_types=1);

return [
    'title' => 'Count Square Submatrices: min of three neighbors + 1',
    'leetcode' => 1277,
    'difficulty' => 'Med',
    'summary' => 'dp[r][c] = side of the largest all-ones square with bottom-right corner (r,c) = 1 + min(up, left, diag) for a 1. It is also how many squares end there. Sum it.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-square-submatrices-with-all-ones',
    'related_session' => 'count-square-submatrices-with-all-ones',
];
