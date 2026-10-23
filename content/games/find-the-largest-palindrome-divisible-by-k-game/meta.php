<?php
declare(strict_types=1);

return [
    'title' => 'Largest Palindrome Divisible by k: greedy digits with a remainder DP',
    'leetcode' => 3260,
    'difficulty' => 'Hard',
    'summary' => 'Fill mirrored digit pairs from the outside in. reach[i][r] says whether the inner pairs can make the total ≡ 0. Pick the largest digit for each pair that keeps a zero remainder reachable.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-largest-palindrome-divisible-by-k',
    'related_session' => 'find-the-largest-palindrome-divisible-by-k',
];
