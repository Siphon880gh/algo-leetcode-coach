<?php
declare(strict_types=1);

return [
    'title' => 'Minimize XOR: popcount of num2, cancel num1’s high bits, fill low zeros',
    'leetcode' => 2429,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: take the bit count from num2, spend it on num1’s set bits from the top, and put any leftover bits in num1’s lowest zero positions. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'minimize-xor',
    'tags' => ['greedy', 'bit-manipulation', 'step-by-step'],
];
