<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Absolute Sum Difference: best single replacement',
    'leetcode' => 1818,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: compute the total; for each i, bisect nums2[i] in sorted nums1 for the closest value; subtract the biggest saving; mod at the end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'minimum-absolute-sum-difference',
    'tags' => ['binary-search', 'sorting', 'array', 'step-by-step'],
];
