<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Bitwise AND After Increment Operations: build the answer bit by bit',
    'leetcode' => 3806,
    'difficulty' => 'Hard',
    'summary' => 'Try bits from high to low. For a candidate t, the cheapest way to make x contain every bit of t is to raise x to the smallest y ≥ x with y AND t = t. Keep the bit if the m cheapest costs fit in k.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['greedy', 'bit-manipulation', 'array', 'sorting', 'leetcode'],
    'related_session' => 'maximum-bitwise-and-after-increment-operations',
];
