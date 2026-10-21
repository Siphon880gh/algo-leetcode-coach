<?php
declare(strict_types=1);

return [
    'title' => 'Kth Missing Positive Number: missing-count search',
    'leetcode' => 1539,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: missing before index i is arr[i] − i − 1; binary search the first index where it reaches k; answer = index + k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'kth-missing-positive-number',
    'tags' => ['binary-search', 'arrays', 'step-by-step'],
];
