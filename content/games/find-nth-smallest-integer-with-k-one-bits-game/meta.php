<?php
declare(strict_types=1);

return [
    'title' => 'Find Nth Smallest Integer With K One Bits',
    'leetcode' => 3821,
    'difficulty' => 'Hard',
    'summary' => 'Decide bits from the top. Leaving bit b at 0 allows C(b, k) numbers using only lower bits. If n is larger than that, bit b must be 1: subtract C(b, k) from n and need one fewer 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'tags' => ['bits', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-nth-smallest-integer-with-k-one-bits',
    'related_session' => 'find-nth-smallest-integer-with-k-one-bits',
];
