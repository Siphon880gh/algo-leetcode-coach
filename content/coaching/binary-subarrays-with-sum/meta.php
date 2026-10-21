<?php
declare(strict_types=1);

return [
    'title' => 'Binary Subarrays With Sum: prefix counts',
    'leetcode' => 930,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a subarray sums to goal when two prefix sums differ by goal, so count earlier prefixes equal to current − goal. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'binary-subarrays-with-sum',
    'tags' => ['prefix-sum', 'hash-table', 'sliding-window', 'step-by-step'],
];
