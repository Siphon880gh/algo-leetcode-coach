<?php
declare(strict_types=1);

return [
    'title' => 'Minimum XOR Path in a Grid',
    'leetcode' => 3882,
    'difficulty' => 'Med',
    'summary' => 'XOR is not monotone, so keep every reachable value: each cell holds a set (bitset of 1024) of XORs from top and left paths, XORed with its own value. The answer is the smallest value in the last cell.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-xor-path-in-a-grid',
    'related_session' => 'minimum-xor-path-in-a-grid',
];
