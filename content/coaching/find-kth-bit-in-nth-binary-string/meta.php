<?php
declare(strict_types=1);

return [
    'title' => 'Find Kth Bit in Nth Binary String: mirror recursion',
    'leetcode' => 1545,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: mid = 2^(n−1); k == mid → 1; k < mid → recurse left; else invert the bit at 2^n − k of S_{n−1}. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'related_guide' => 'find-kth-bit-in-nth-binary-string',
    'tags' => ['recursion', 'strings', 'step-by-step'],
];
