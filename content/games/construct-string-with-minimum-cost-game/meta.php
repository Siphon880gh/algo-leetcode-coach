<?php
declare(strict_types=1);

return [
    'title' => 'Construct String With Minimum Cost: DP over target prefixes',
    'leetcode' => 3213,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = cheapest way to build target[0..i). From every reachable i, append each word that matches target at i (Aho–Corasick or hashing in the fast version).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'construct-string-with-minimum-cost',
    'related_session' => 'construct-string-with-minimum-cost',
];
