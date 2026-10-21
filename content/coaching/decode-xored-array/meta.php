<?php
declare(strict_types=1);

return [
    'title' => 'Decode XORed Array: undo XOR step by step',
    'leetcode' => 1720,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: arr[0] = first, then arr[i + 1] = arr[i] ^ encoded[i]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'decode-xored-array',
    'tags' => ['bit-manipulation', 'array', 'step-by-step'],
];
