<?php
declare(strict_types=1);

return [
    'title' => 'K-th Smallest Prime Fraction: count below a guess',
    'leetcode' => 786,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: binary search a real x, count fractions ≤ x with two pointers while tracking the largest, and stop when the count is exactly k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'k-th-smallest-prime-fraction',
    'tags' => ['binary-search', 'two-pointers', 'heap', 'sorting', 'step-by-step'],
];
