<?php
declare(strict_types=1);

return [
    'title' => 'Total Hamming Distance: per bit, ones times zeros',
    'leetcode' => 477,
    'difficulty' => 'Med',
    'summary' => 'Sum of Hamming distances over all pairs. Do not loop pairs. For each bit position, if a values have a 1 and n − a have a 0, that bit adds a × (n − a). Sum over 32 bits. [4,14,2] → 6. [4,14,4] → 4. Not 461 (one pair).',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'counting', 'leetcode'],
    'related_session' => 'total-hamming-distance',
];
