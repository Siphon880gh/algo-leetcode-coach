<?php
declare(strict_types=1);

return [
    'title' => 'Filling Bookcase Shelves: which books share the last shelf?',
    'leetcode' => 1105,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = least height for the first i books. The last shelf holds books j..i−1 while their thickness fits: dp[j] + max height among them.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'filling-bookcase-shelves',
    'related_session' => 'filling-bookcase-shelves',
];
