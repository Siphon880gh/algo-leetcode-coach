<?php
declare(strict_types=1);

return [
    'title' => 'Number of Integers With Popcount-Depth Equal to K II: one Fenwick tree per depth',
    'leetcode' => 3624,
    'difficulty' => 'Hard',
    'summary' => 'Depths are at most 5 for values up to 10^15, so keep a Fenwick tree for each depth. An update moves one index between trees; a query is a range count in tree k.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Indexed Tree',
    'topic' => 'LeetCode · Binary Indexed Tree',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'array', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'number-of-integers-with-popcount-depth-equal-to-k-ii',
];
