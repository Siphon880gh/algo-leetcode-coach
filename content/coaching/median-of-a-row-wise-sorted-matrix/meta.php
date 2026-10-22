<?php
declare(strict_types=1);

return [
    'title' => 'Median of a Row Wise Sorted Matrix: count ≤ x, need (mn + 1) / 2, keep mid',
    'leetcode' => 2387,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count values ≤ x in each row, look for the first count reaching (m · n + 1) / 2, and keep mid in range when it qualifies. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'median-of-a-row-wise-sorted-matrix',
    'tags' => ['array', 'binary-search', 'matrix', 'step-by-step'],
];
