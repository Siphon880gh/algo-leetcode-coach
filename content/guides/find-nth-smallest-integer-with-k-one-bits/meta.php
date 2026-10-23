<?php
declare(strict_types=1);

return [
    'title' => 'Find Nth Smallest Integer With K One Bits: choose bits from the top',
    'leetcode' => 3821,
    'difficulty' => 'Hard',
    'summary' => 'There are C(p, k) numbers below 2^p with k ones. Walk p from high to low: if n > C(p, k), the answer has bit p set, so subtract C(p, k) and use one fewer 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'combinatorics', 'leetcode'],
    'related_session' => 'find-nth-smallest-integer-with-k-one-bits',
];
