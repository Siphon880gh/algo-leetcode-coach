<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Threshold for Inversion Pairs Count: binary search x, count with a BIT',
    'leetcode' => 3520,
    'difficulty' => 'Med',
    'summary' => 'The count of inversion pairs with difference ≤ x only grows with x. For a fixed x, scan left to right and count earlier values in (v, v + x] with a Fenwick tree over compressed values.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'array', 'binary-search', 'divide-and-conquer', 'merge-sort', 'leetcode'],
    'related_session' => 'minimum-threshold-for-inversion-pairs-count',
];
