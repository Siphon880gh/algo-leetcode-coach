<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR for Each Query: complement the running XOR',
    'leetcode' => 1829,
    'difficulty' => 'Med',
    'summary' => 'XOR everything once. The best k for total x is x XOR (2^maximumBit − 1). Answer for the full array, then remove elements from the end by XORing them out.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'prefix-sum', 'array', 'leetcode'],
    'related_session' => 'maximum-xor-for-each-query',
];
