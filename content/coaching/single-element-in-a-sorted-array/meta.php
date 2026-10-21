<?php
declare(strict_types=1);

return [
    'title' => 'Single Element in a Sorted Array: binary search on pair alignment',
    'leetcode' => 540,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the one unpaired value in a sorted array of pairs, in O(log n). Before it, pairs start at even indexes. Binary search an even mid: nums[mid] == nums[mid + 1] → go right (lo = mid + 2), else hi = mid. [1,1,2,3,3,4,4,8,8] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'arrays', 'bit-manipulation', 'step-by-step'],
    'related_guide' => 'single-element-in-a-sorted-array',
];
