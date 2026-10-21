<?php
declare(strict_types=1);

return [
    'title' => 'Hamming Distance: XOR, then count the set bits',
    'leetcode' => 461,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: count bit positions where x and y differ. x XOR y has a 1 exactly there; count its set bits with z & (z − 1) or a popcount. x = 1, y = 4 → 2. x = 3, y = 1 → 1. Not 477. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bit-manipulation', 'math', 'step-by-step'],
    'related_guide' => 'hamming-distance',
];
