<?php
declare(strict_types=1);

return [
    'title' => 'Count Triplets With Equal XOR: zero-XOR ranges',
    'leetcode' => 1442,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: a == b iff arr[i..k] XORs to 0; each such range gives k − i choices of j. Use prefix XOR. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'count-triplets-that-can-form-two-arrays-of-equal-xor',
    'tags' => ['bit-manipulation', 'prefix-sum', 'hash-map', 'step-by-step'],
];
