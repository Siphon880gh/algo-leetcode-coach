<?php
declare(strict_types=1);

return [
    'title' => '4Sum II: meet in the middle with a hash map of pair sums',
    'leetcode' => 454,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count tuples with nums1[i] + nums2[j] + nums3[k] + nums4[l] = 0. Count every pair sum a + b in a hash map, then add count[−(c + d)] for every c + d. O(n²) instead of O(n⁴). [1,2],[−2,−1],[−1,2],[0,2] → 2. Not 18. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'tags' => ['hash-table', 'arrays', 'meet-in-the-middle', 'step-by-step'],
    'related_guide' => '4sum-ii',
];
