<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With More Ones Than Zeros: ±1 prefix counts',
    'leetcode' => 2031,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: 1 → +1, 0 → −1, count earlier prefixes strictly below the current one in O(1) per step. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'count-subarrays-with-more-ones-than-zeros',
    'tags' => ['prefix-sum', 'hash-table', 'counting', 'step-by-step'],
];
