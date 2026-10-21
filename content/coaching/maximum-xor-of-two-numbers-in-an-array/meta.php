<?php
declare(strict_types=1);

return [
    'title' => 'Maximum XOR of Two Numbers: binary trie, prefer the opposite bit',
    'leetcode' => 421,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: max nums[i] XOR nums[j] with n up to 2e5. Insert each value as 31 bits (30 down to 0) into a 0/1 trie. For each x, walk the opposite bit whenever that child exists. [3,10,5,25,2,8] → 28 (5 XOR 25). Not pairwise O(n²). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Trie',
    'topic' => 'LeetCode · Trie',
    'tags' => ['trie', 'bit-manipulation', 'step-by-step'],
    'related_guide' => 'maximum-xor-of-two-numbers-in-an-array',
];
