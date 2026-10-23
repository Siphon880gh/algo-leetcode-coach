<?php
declare(strict_types=1);

return [
    'title' => 'Find Maximum Balanced XOR Subarray Length: first-seen prefix states',
    'leetcode' => 3755,
    'difficulty' => 'Med',
    'summary' => 'A subarray works when its XOR is 0 and odds minus evens is 0, so the prefix XOR and prefix balance repeat. Keep the first index of each (xor, balance) pair.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'array', 'hash-table', 'prefix-sum', 'leetcode'],
    'related_session' => 'find-maximum-balanced-xor-subarray-length',
];
