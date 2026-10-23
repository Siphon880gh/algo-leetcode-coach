<?php
declare(strict_types=1);

return [
    'title' => 'Valid K-Unique Subarrays I: XOR hashing plus offline distinct counts',
    'leetcode' => 4033,
    'difficulty' => 'Hard',
    'summary' => 'Give each value a random 64-bit hash. Every count in a range is even exactly when the XOR of hashes over it is 0, which prefix XORs answer in O(1). Count distinct values offline: sort queries by right end and keep only the last position of each value in a Fenwick tree.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'leetcode'],
    'related_session' => 'valid-k-unique-subarrays-i',
];
