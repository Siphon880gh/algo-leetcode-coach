<?php
declare(strict_types=1);

return [
    'title' => 'Find Xor-Beauty of Array: everything cancels to the XOR of nums',
    'leetcode' => 2527,
    'difficulty' => 'Med',
    'summary' => 'Swapping i and j gives the same value, so all pairs with i ≠ j cancel under XOR, leaving nums[i] & nums[k]. The same symmetry cancels i ≠ k, leaving nums[i]. The answer is the XOR of all elements.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'bit-manipulation', 'leetcode'],
    'related_session' => 'find-xor-beauty-of-array',
];
