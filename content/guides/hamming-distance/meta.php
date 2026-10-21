<?php
declare(strict_types=1);

return [
    'title' => 'Hamming Distance: XOR, then count the set bits',
    'leetcode' => 461,
    'difficulty' => 'Easy',
    'summary' => 'Count bit positions where x and y differ. x XOR y has a 1 exactly at those positions, so count its set bits — clear the lowest set bit with z & (z − 1) until zero, or use a built-in popcount. x = 1, y = 4 → 2. x = 3, y = 1 → 1. Same as 2220. Not 477 (all pairs).',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'leetcode'],
    'related_session' => 'hamming-distance',
];
