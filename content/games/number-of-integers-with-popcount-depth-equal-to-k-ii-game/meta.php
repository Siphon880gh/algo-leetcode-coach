<?php
declare(strict_types=1);

return [
    'title' => 'Number of Integers With Popcount-Depth Equal to K II',
    'leetcode' => 3624,
    'difficulty' => 'Hard',
    'summary' => 'Depth is at most 5, so keep one Fenwick tree per depth over the positions. An update moves index i from its old depth\'s tree to the new one; a query [l, r, k] is a range count in tree k.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-integers-with-popcount-depth-equal-to-k-ii',
    'related_session' => 'number-of-integers-with-popcount-depth-equal-to-k-ii',
];
