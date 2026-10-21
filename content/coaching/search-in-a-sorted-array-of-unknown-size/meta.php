<?php
declare(strict_types=1);

return [
    'title' => 'Search in a Sorted Array of Unknown Size: bracket, then search',
    'leetcode' => 702,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: double hi until get(hi) ≥ target, then binary search between the last two bounds, treating out-of-range as +∞. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'search-in-a-sorted-array-of-unknown-size',
    'tags' => ['binary-search', 'interactive', 'step-by-step'],
];
