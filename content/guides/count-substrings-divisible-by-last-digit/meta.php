<?php
declare(strict_types=1);

return [
    'title' => 'Count Substrings Divisible By Last Digit: remainders for every divisor',
    'leetcode' => 3448,
    'difficulty' => 'Hard',
    'summary' => 'For each d from 1 to 9, keep how many substrings ending at the current index have each remainder mod d. Appending digit c maps remainder r to (10r + c) mod d and adds the new one-digit substring. If c ≠ 0, add the count with remainder 0 mod c.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-substrings-divisible-by-last-digit',
];
