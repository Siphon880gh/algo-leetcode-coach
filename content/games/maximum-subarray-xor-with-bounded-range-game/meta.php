<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray XOR With Bounded Range',
    'leetcode' => 3845,
    'difficulty' => 'Hard',
    'summary' => 'Two pointers with max/min deques keep the longest window ending at r with max − min ≤ k. Any subarray ending at r inside it is allowed; with prefix XORs P, the best is max P[r+1] ⊕ P[j] over j in [l, r], found in a binary trie that supports deletions.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subarray-xor-with-bounded-range',
    'related_session' => 'maximum-subarray-xor-with-bounded-range',
];
