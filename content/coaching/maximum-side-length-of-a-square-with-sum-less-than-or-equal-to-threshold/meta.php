<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Side Length of a Square with Sum ≤ Threshold: prefix sums',
    'leetcode' => 1292,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build a 2D prefix table so each square sum is O(1), then binary search or grow the side while some square fits. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'maximum-side-length-of-a-square-with-sum-less-than-or-equal-to-threshold',
    'tags' => ['prefix-sum', 'binary-search', 'matrix', 'step-by-step'],
];
