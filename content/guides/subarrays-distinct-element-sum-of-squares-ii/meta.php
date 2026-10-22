<?php
declare(strict_types=1);

return [
    'title' => 'Subarrays Distinct Element Sum of Squares II: segment tree over left ends',
    'leetcode' => 2916,
    'difficulty' => 'Hard',
    'summary' => 'Sweep the right end r. Adding nums[r] raises the distinct count by 1 for left ends after its previous occurrence; the sum of squares grows by 2·(sum of those counts) + (how many). A lazy segment tree gives the range sum and range add.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'segment-tree', 'binary-indexed-tree', 'leetcode'],
    'related_session' => 'subarrays-distinct-element-sum-of-squares-ii',
];
