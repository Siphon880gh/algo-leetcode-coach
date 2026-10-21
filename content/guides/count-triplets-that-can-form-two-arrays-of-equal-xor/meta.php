<?php
declare(strict_types=1);

return [
    'title' => 'Count Triplets That Can Form Two Arrays of Equal XOR: zero-XOR ranges',
    'leetcode' => 1442,
    'difficulty' => 'Med',
    'summary' => 'a == b means arr[i..k] XORs to 0. Every such range with i < k contributes k − i choices of j. Use prefix XOR with counts and index sums for O(n).',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'prefix-sum', 'hash-map', 'leetcode'],
    'related_session' => 'count-triplets-that-can-form-two-arrays-of-equal-xor',
];
