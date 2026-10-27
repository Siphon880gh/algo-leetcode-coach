<?php
declare(strict_types=1);

return [
    'title' => 'Count Smaller Elements With Opposite Parity',
    'leetcode' => 3907,
    'difficulty' => 'Med',
    'summary' => 'Sweep from the right with two Fenwick trees over compressed values, one for evens and one for odds. For index i, query the tree of the opposite parity for values smaller than nums[i], then insert nums[i] into its own tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-smaller-elements-with-opposite-parity',
    'related_session' => 'count-smaller-elements-with-opposite-parity',
];
