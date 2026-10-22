<?php
declare(strict_types=1);

return [
    'title' => 'Smallest Subarrays With Maximum Bitwise OR: own bits first, include i, suffix target',
    'leetcode' => 2411,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: record nums[i]’s bits before answering, keep i itself as the minimum end, and aim for the suffix OR rather than the whole array’s. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'smallest-subarrays-with-maximum-bitwise-or',
    'tags' => ['array', 'binary-search', 'bit-manipulation', 'sliding-window', 'step-by-step'],
];
