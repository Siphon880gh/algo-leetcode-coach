<?php
declare(strict_types=1);

return [
    'title' => 'Number of Pairs Satisfying Inequality',
    'leetcode' => 2426,
    'difficulty' => 'Hard',
    'summary' => 'Rewrite with d[i] = nums1[i] − nums2[i]: count i < j with d[i] at most d[j] + diff. Scan j, querying a Fenwick tree (or merge sort) for earlier d[i] at most d[j] + diff.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-pairs-satisfying-inequality',
    'related_session' => 'number-of-pairs-satisfying-inequality',
];
