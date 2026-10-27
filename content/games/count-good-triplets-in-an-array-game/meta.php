<?php
declare(strict_types=1);

return [
    'title' => 'Count Good Triplets in an Array',
    'leetcode' => 2179,
    'difficulty' => 'Hard',
    'summary' => 'Map each value to its position in nums2, then walk nums1: for each middle element, (# earlier with smaller nums2 position) times (# later with larger position) — both from a Fenwick tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'tags' => ['range-tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-good-triplets-in-an-array',
    'related_session' => 'count-good-triplets-in-an-array',
];
