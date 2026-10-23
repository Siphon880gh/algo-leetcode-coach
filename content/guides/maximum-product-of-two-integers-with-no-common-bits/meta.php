<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Product of Two Integers With No Common Bits: SOS DP',
    'leetcode' => 3670,
    'difficulty' => 'Med',
    'summary' => 'F[mask] = the largest value whose bits are a subset of mask. For each x, its best partner is F[complement of x]. A value never pairs with itself, since x AND x = x ≠ 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-product-of-two-integers-with-no-common-bits',
];
