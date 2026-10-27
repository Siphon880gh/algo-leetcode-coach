<?php
declare(strict_types=1);

return [
    'title' => 'Count Substrings Divisible by Last Digit: remainders per divisor',
    'leetcode' => 3448,
    'difficulty' => 'Hard',
    'summary' => 'For each divisor d in 1 to 9 keep cnt[d][r] = substrings ending at the previous index with value ≡ r (mod d). Extending by digit c maps r to (10r + c) mod d. If c not equal to 0, add cnt[c][0] (including the single digit).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-substrings-divisible-by-last-digit',
    'related_session' => 'count-substrings-divisible-by-last-digit',
];
