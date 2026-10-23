<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum Queries',
    'leetcode' => 2736,
    'difficulty' => 'Hard',
    'summary' => 'Offline: sort points by nums1 descending and queries by x descending; insert points with nums1 ≥ x into a structure keyed by nums2 (monotonic stack + binary search, or a max segment tree) and query max sum with nums2 ≥ y.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-sum-queries',
    'related_session' => 'maximum-sum-queries',
];
