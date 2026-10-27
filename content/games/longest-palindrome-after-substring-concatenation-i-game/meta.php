<?php
declare(strict_types=1);

return [
    'title' => 'Longest Palindrome After Substring Concatenation I: mirror match plus a palindrome',
    'leetcode' => 3503,
    'difficulty' => 'Med',
    'summary' => 'The answer is a palindrome inside s or t, or X then P from s with reverse(X) from t (P a palindrome in s right after X), or X from s with P then reverse(X) from t. Matching s ending at i against t read backwards from j gives the possible X lengths.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['mini-game', 'leetcode', 'dynamic-programming'],
    'entry' => 'index.html',
    'related_guide' => 'longest-palindrome-after-substring-concatenation-i',
    'related_session' => 'longest-palindrome-after-substring-concatenation-i',
];
