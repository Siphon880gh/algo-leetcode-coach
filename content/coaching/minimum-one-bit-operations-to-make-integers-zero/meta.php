<?php
declare(strict_types=1);

return [
    'title' => 'Minimum One Bit Operations: inverse Gray code',
    'leetcode' => 1611,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the moves trace the Gray-code order, so the answer is the Gray index of n, computed as n ^ (n >> 1) ^ (n >> 2) ^ …. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'minimum-one-bit-operations-to-make-integers-zero',
    'tags' => ['bit-manipulation', 'math', 'recursion', 'step-by-step'],
];
