<?php
declare(strict_types=1);

return [
    'title' => 'Fixed Point: binary search on arr[i] − i',
    'leetcode' => 1064,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: arr[i] − i never decreases, so binary search the first i with arr[i] ≥ i and check equality there. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'fixed-point',
    'tags' => ['binary-search', 'arrays', 'step-by-step'],
];
