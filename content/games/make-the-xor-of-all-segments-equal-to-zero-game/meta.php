<?php
declare(strict_types=1);

return [
    'title' => 'Make the XOR of All Segments Zero: one value per residue class',
    'leetcode' => 1787,
    'difficulty' => 'Hard',
    'summary' => 'All indices with the same i mod k must hold the same value, and the k values must XOR to 0. dp[x] = fewest changes for the first groups with XOR x. A group either keeps one of its values v (dp[x ^ v] + size − count[v]) or changes all (min dp + size).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'make-the-xor-of-all-segments-equal-to-zero',
    'related_session' => 'make-the-xor-of-all-segments-equal-to-zero',
];
