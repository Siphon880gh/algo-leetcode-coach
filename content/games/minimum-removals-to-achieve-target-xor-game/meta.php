<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Removals to Achieve Target XOR',
    'leetcode' => 3877,
    'difficulty' => 'Med',
    'summary' => 'DP over XOR values: best[x] = most elements we can keep with XOR x (−∞ if unreachable). Each element either is removed or keeps x to x ⊕ v with one more kept. Answer n − best[target], or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-removals-to-achieve-target-xor',
    'related_session' => 'minimum-removals-to-achieve-target-xor',
];
