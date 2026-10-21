<?php
declare(strict_types=1);

return [
    'title' => 'Total Hamming Distance: per bit, ones times zeros',
    'leetcode' => 477,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sum Hamming distances over all pairs. For each bit, a values with a 1 and n − a with a 0 give a × (n − a) differing pairs. Sum over 32 bits. [4,14,2] → 6. [4,14,4] → 4. Not 461 per pair. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bit-manipulation', 'math', 'counting', 'step-by-step'],
    'related_guide' => 'total-hamming-distance',
];
