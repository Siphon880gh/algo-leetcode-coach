<?php
declare(strict_types=1);

return [
    'title' => 'Number of Pairs Satisfying Inequality: d = nums1 − nums2, ≤, 64-bit',
    'leetcode' => 2426,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: subtract nums2 from nums1 for each index, count earlier values at most d[j] + diff, and keep the count in 64-bit. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Divide and Conquer',
    'topic' => 'LeetCode · Divide and Conquer',
    'related_guide' => 'number-of-pairs-satisfying-inequality',
    'tags' => ['array', 'binary-search', 'divide-and-conquer', 'binary-indexed-tree', 'segment-tree', 'merge-sort', 'ordered-set', 'step-by-step'],
];
