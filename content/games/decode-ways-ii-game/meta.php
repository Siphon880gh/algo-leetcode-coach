<?php
declare(strict_types=1);

return [
    'title' => 'Decode Ways II: count what a star can stand for',
    'leetcode' => 639,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = ways for the first i characters. One character: "*" gives 9 · dp[i−1], a nonzero digit 1 · dp[i−1]. Two characters: count valid pairs 10..26 (a star covers 1..9) times dp[i−2].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'decode-ways-ii',
    'related_session' => 'decode-ways-ii',
];
