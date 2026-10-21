<?php
declare(strict_types=1);

return [
    'title' => 'Minimum One Bit Operations to Make Integers Zero: inverse Gray code',
    'leetcode' => 1611,
    'difficulty' => 'Hard',
    'summary' => 'The two allowed moves walk the Gray-code sequence, so the answer is the index of n in that sequence: the prefix XOR n ^ (n >> 1) ^ (n >> 2) ^ ….',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'recursion', 'leetcode'],
    'related_session' => 'minimum-one-bit-operations-to-make-integers-zero',
];
