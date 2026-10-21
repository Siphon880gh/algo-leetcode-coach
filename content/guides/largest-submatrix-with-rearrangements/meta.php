<?php
declare(strict_types=1);

return [
    'title' => 'Largest Submatrix With Rearrangements: sorted column heights',
    'leetcode' => 1727,
    'difficulty' => 'Med',
    'summary' => 'For each row, compute the height of consecutive ones ending there in every column. Columns can be reordered, so sort the heights descending; the best rectangle at that row is max over i of height[i] · (i + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'matrix', 'leetcode'],
    'related_session' => 'largest-submatrix-with-rearrangements',
];
