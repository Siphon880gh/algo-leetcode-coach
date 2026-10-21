<?php
declare(strict_types=1);

return [
    'title' => 'Single Element in a Sorted Array: binary search on pair alignment',
    'leetcode' => 540,
    'difficulty' => 'Med',
    'summary' => 'Every value appears twice except one, and the array is sorted. Before the single element, pairs start at even indexes; after it, at odd. Binary search an even mid: if nums[mid] == nums[mid + 1], the single is to the right (lo = mid + 2), else hi = mid. [1,1,2,3,3,4,4,8,8] → 2. [3,3,7,7,10,11,11] → 10. O(log n).',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'arrays', 'bit-manipulation', 'leetcode'],
    'related_session' => 'single-element-in-a-sorted-array',
];
