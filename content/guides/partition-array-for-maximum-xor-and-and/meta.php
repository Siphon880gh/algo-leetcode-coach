<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array for Maximum XOR and AND: enumerate B, then a linear basis',
    'leetcode' => 3630,
    'difficulty' => 'Hard',
    'summary' => 'Try every subset as B. For the rest with total XOR X, XOR(A) + XOR(C) = a + (X ^ a) = X + 2 · (a & ~X), so maximize a & ~X with a linear basis over the rest masked by ~X.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'array', 'math', 'enumeration', 'leetcode'],
    'related_session' => 'partition-array-for-maximum-xor-and-and',
];
