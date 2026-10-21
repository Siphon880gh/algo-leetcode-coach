<?php
declare(strict_types=1);

return [
    'title' => 'Concatenation of Consecutive Binary Numbers: shift and add',
    'leetcode' => 1680,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: r = ((r << bitlen(i)) + i) mod 1e9+7 for i = 1 … n; the bit length grows at powers of two. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'concatenation-of-consecutive-binary-numbers',
    'tags' => ['bit-manipulation', 'math', 'simulation', 'step-by-step'],
];
