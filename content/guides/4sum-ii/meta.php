<?php
declare(strict_types=1);

return [
    'title' => '4Sum II: meet in the middle with a hash map of pair sums',
    'leetcode' => 454,
    'difficulty' => 'Med',
    'summary' => 'Count index tuples (i, j, k, l) with nums1[i] + nums2[j] + nums3[k] + nums4[l] = 0. Count every a + b from the first two arrays in a hash map, then for every c + d from the last two add count[−(c + d)]. O(n²) instead of O(n⁴). [1,2],[−2,−1],[−1,2],[0,2] → 2. Not 18 (4Sum on one array).',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'arrays', 'meet-in-the-middle', 'leetcode'],
    'related_session' => '4sum-ii',
];
