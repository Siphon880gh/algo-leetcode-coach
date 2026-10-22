<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Strictly Increasing Cells in a Matrix: sort, then best per row and column',
    'leetcode' => 2713,
    'difficulty' => 'Hard',
    'summary' => 'Process cells in increasing value. A cell’s best path is 1 plus the best seen so far in its row or column. Compute a whole group of equal values before updating, so equal cells cannot chain.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'dynamic-programming', 'matrix', 'sorting', 'leetcode'],
    'related_session' => 'maximum-strictly-increasing-cells-in-a-matrix',
];
