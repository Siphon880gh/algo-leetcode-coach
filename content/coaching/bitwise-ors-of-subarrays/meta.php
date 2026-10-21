<?php
declare(strict_types=1);

return [
    'title' => 'Bitwise ORs of Subarrays: carry the small set forward',
    'leetcode' => 898,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the ORs of subarrays ending at i come from ORing a[i] into those ending at i − 1 plus a[i] itself; the set stays at about 30 values. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'bitwise-ors-of-subarrays',
    'tags' => ['bit-manipulation', 'dynamic-programming', 'hash-table', 'step-by-step'],
];
