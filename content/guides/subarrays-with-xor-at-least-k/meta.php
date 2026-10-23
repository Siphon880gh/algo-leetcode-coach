<?php
declare(strict_types=1);

return [
    'title' => 'Subarrays with XOR at Least K: binary trie over prefix XORs',
    'leetcode' => 3632,
    'difficulty' => 'Hard',
    'summary' => 'A subarray XOR is p ^ q for two prefix XORs. Keep earlier prefixes in a binary trie; for each new prefix count those with p ^ q < k, and add the rest.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'trie', 'array', 'prefix-sum', 'leetcode'],
    'related_session' => 'subarrays-with-xor-at-least-k',
];
