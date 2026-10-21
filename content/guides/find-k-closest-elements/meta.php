<?php
declare(strict_types=1);

return [
    'title' => 'Find K Closest Elements: binary search the window\'s left edge',
    'leetcode' => 658,
    'difficulty' => 'Med',
    'summary' => 'The answer is a window of k consecutive values. Binary search its left edge in [0, n − k]: if x is closer to arr[mid + k] than to arr[mid], move right; otherwise move left.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'two-pointers', 'sliding-window', 'arrays', 'leetcode'],
    'related_session' => 'find-k-closest-elements',
];
