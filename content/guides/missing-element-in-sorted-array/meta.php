<?php
declare(strict_types=1);

return [
    'title' => 'Missing Element in Sorted Array: binary search on the missing count',
    'leetcode' => 1060,
    'difficulty' => 'Med',
    'summary' => 'The count of numbers missing before index i is nums[i] − nums[0] − i, and it never decreases. Binary search for the first index where that count reaches k, then step forward from the element before it.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'arrays', 'leetcode'],
    'related_session' => 'missing-element-in-sorted-array',
];
