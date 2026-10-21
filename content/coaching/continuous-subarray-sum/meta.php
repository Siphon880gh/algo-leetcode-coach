<?php
declare(strict_types=1);

return [
    'title' => 'Continuous Subarray Sum: prefix mod k with the first index seen',
    'leetcode' => 523,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a subarray of length ≥ 2 with sum a multiple of k? Equal prefix remainders mod k bound one. Store the first index of each remainder, seeded {0: −1}; true if the gap is ≥ 2. [23,2,4,6,7], 6 → true. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'hash-table', 'math', 'step-by-step'],
    'related_guide' => 'continuous-subarray-sum',
];
