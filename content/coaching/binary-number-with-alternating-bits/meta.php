<?php
declare(strict_types=1);

return [
    'title' => 'Binary Number with Alternating Bits: XOR with a shift',
    'leetcode' => 693,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: n ^ (n >> 1) is all ones exactly when the bits alternate, and all ones means x & (x + 1) == 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'binary-number-with-alternating-bits',
    'tags' => ['bit-manipulation', 'math', 'step-by-step'],
];
