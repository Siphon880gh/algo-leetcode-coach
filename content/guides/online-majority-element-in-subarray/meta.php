<?php
declare(strict_types=1);

return [
    'title' => 'Online Majority Element In Subarray: segment tree vote plus check',
    'leetcode' => 1157,
    'difficulty' => 'Hard',
    'summary' => 'Store a Boyer-Moore (candidate, count) pair in each segment tree node, so a range query gives the only possible majority. Then count it in the range by binary searching its sorted index list.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'binary-search', 'design', 'leetcode'],
    'related_session' => 'online-majority-element-in-subarray',
];
