<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subsequence Score: sort by the multiplier, drop the smallest sum',
    'leetcode' => 2542,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort by nums2 so each index is the current minimum, and keep the k largest nums1 values with a min-heap. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'maximum-subsequence-score',
    'tags' => ['array', 'greedy', 'sorting', 'heap', 'step-by-step'],
];
