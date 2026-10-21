<?php
declare(strict_types=1);

return [
    'title' => 'Missing Element in Sorted Array: binary search on missing count',
    'leetcode' => 1060,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the count missing before index i is nums[i] − nums[0] − i; handle the answer beyond the end, otherwise binary search the first index whose count reaches k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'missing-element-in-sorted-array',
    'tags' => ['binary-search', 'arrays', 'step-by-step'],
];
