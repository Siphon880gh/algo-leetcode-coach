<?php
declare(strict_types=1);

return [
    'title' => 'Subarrays with XOR at Least K',
    'leetcode' => 3632,
    'difficulty' => 'Hard',
    'summary' => 'With prefix XORs P, a subarray (j, i] has XOR P[i] ^ P[j]. Insert prefixes into a binary trie storing counts; for each P[i], walk the trie bit by bit against k to count earlier prefixes with P[i] ^ P[j] ≥ k.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'subarrays-with-xor-at-least-k',
    'related_session' => 'subarrays-with-xor-at-least-k',
];
