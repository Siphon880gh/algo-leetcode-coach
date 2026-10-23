<?php
declare(strict_types=1);

return [
    'title' => 'Kth Missing Element in a Sorted Array',
    'leetcode' => 1060,
    'difficulty' => 'Med',
    'summary' => 'missing(i) = nums[i] − nums[0] − i. Binary search the last i with missing(i) < k; the answer is nums[i] + k − missing(i).',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'missing-element-in-sorted-array',
    'related_session' => 'missing-element-in-sorted-array',
];
