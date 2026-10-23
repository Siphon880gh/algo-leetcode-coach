<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray XOR with Bounded Range: sliding window plus a binary trie',
    'leetcode' => 3845,
    'difficulty' => 'Hard',
    'summary' => 'For each right end r the valid left ends form a window [l, r] that only moves right, tracked with max and min deques. Keep the prefix XORs P[l … r] in a trie with counts and ask for the best partner of P[r + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'trie', 'queue', 'array', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'leetcode'],
    'related_session' => 'maximum-subarray-xor-with-bounded-range',
];
