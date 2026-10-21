<?php
declare(strict_types=1);

return [
    'title' => 'Largest 1-Bordered Square: run lengths left and up',
    'leetcode' => 1139,
    'difficulty' => 'Med',
    'summary' => 'Precompute, for every cell, how many consecutive 1s end there going left and going up. A square of side k with bottom-right corner (i, j) has a full border when all four sides have runs of at least k, which four lookups check.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'largest-1-bordered-square',
];
