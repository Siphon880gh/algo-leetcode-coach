<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR With Limit: offline trie',
    'leetcode' => 1707,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort nums and queries by limit; insert nums ≤ m into a binary trie; greedily take opposite bits of x; −1 if the trie is empty. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'related_guide' => 'maximum-xor-with-an-element-from-array',
    'tags' => ['trie', 'bit-manipulation', 'sorting', 'step-by-step'],
];
