<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR for Each Query: complement the running XOR',
    'leetcode' => 1829,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: x = XOR of all; for each element from the end, answer x ^ (2^maximumBit − 1), then XOR that element out. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'maximum-xor-for-each-query',
    'tags' => ['bit-manipulation', 'prefix-sum', 'array', 'step-by-step'],
];
