<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Good Subarray Sum: smallest prefix per value',
    'leetcode' => 3026,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: remember the smallest prefix sum before each value and look up nums[j] ± k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'maximum-good-subarray-sum',
    'tags' => ['array', 'hash-table', 'prefix-sum', 'step-by-step'],
];
