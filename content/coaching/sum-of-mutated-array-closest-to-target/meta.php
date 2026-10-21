<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Mutated Array Closest to Target: even share of the rest',
    'leetcode' => 1300,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort, keep a prefix sum, and at the first index where the even share (target − prefix) / remaining is at most arr[i], compare its floor and floor + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'sum-of-mutated-array-closest-to-target',
    'tags' => ['sorting', 'binary-search', 'step-by-step'],
];
