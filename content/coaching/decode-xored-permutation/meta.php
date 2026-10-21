<?php
declare(strict_types=1);

return [
    'title' => 'Decode XORed Permutation: recover the first element',
    'leetcode' => 1734,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: XOR 1 … n, XOR it with encoded at odd indices to get perm[0], then decode forward. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'related_guide' => 'decode-xored-permutation',
    'tags' => ['bit-manipulation', 'array', 'step-by-step'],
];
