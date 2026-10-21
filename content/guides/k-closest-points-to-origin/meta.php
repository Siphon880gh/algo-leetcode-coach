<?php
declare(strict_types=1);

return [
    'title' => 'K Closest Points to Origin: a bounded max-heap',
    'leetcode' => 973,
    'difficulty' => 'Med',
    'summary' => 'Keep the k closest points seen so far in a max-heap keyed by squared distance; when it grows past k, drop the farthest. Quickselect also gives the k smallest in O(n) on average.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['heap', 'sorting', 'divide-and-conquer', 'leetcode'],
    'related_session' => 'k-closest-points-to-origin',
];
