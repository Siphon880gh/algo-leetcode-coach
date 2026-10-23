<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subarray XOR with Bounded Range: sliding window plus a binary trie',
    'leetcode' => 3845,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: deques bound the window, the trie finds the best prefix. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'maximum-subarray-xor-with-bounded-range',
    'tags' => ['bit-manipulation', 'trie', 'queue', 'array', 'prefix-sum', 'sliding-window', 'monotonic-queue', 'step-by-step'],
];
