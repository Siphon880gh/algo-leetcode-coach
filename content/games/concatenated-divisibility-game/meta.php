<?php
declare(strict_types=1);

return [
    'title' => 'Concatenated Divisibility',
    'leetcode' => 3533,
    'difficulty' => 'Hard',
    'summary' => 'Bitmask DP over (used numbers, current remainder) tells whether a prefix can still be finished into a multiple of k. Build the answer greedily: try the smallest remaining number first and keep it only if the rest can still succeed.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'concatenated-divisibility',
    'related_session' => 'concatenated-divisibility',
];
