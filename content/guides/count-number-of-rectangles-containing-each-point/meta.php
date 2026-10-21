<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Rectangles Containing Each Point: bucket by height',
    'leetcode' => 2250,
    'difficulty' => 'Med',
    'summary' => 'Heights are at most 100. Group rectangle lengths by height and sort each group. For a point (x, y), sum over heights h ≥ y the number of lengths ≥ x by binary search.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'binary-indexed-tree', 'sorting', 'leetcode'],
    'related_session' => 'count-number-of-rectangles-containing-each-point',
];
