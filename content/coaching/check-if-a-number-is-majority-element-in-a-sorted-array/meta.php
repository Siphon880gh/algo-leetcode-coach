<?php
declare(strict_types=1);

return [
    'title' => 'Majority Element in a Sorted Array: jump n // 2',
    'leetcode' => 1150,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: binary search the first index i of target, then check that index i + n // 2 is in range and still holds target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'check-if-a-number-is-majority-element-in-a-sorted-array',
    'tags' => ['binary-search', 'arrays', 'step-by-step'],
];
