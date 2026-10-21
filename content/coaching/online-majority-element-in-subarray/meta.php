<?php
declare(strict_types=1);

return [
    'title' => 'Online Majority Element In Subarray: vote tree and verify',
    'leetcode' => 1157,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: build a segment tree that merges Boyer-Moore votes, get the range candidate, and confirm its frequency with binary search on its index list. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'related_guide' => 'online-majority-element-in-subarray',
    'tags' => ['segment-tree', 'binary-search', 'design', 'step-by-step'],
];
