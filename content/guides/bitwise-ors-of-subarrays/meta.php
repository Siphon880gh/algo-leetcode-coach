<?php
declare(strict_types=1);

return [
    'title' => 'Bitwise ORs of Subarrays: the set of ORs ending here stays small',
    'leetcode' => 898,
    'difficulty' => 'Med',
    'summary' => 'The ORs of subarrays ending at i form a chain where each new value adds bits, so there are at most about 30 of them. Carry that set forward, OR it with the next element, and union everything.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'dynamic-programming', 'hash-table', 'leetcode'],
    'related_session' => 'bitwise-ors-of-subarrays',
];
