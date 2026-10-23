<?php
declare(strict_types=1);

return [
    'title' => 'Longest Almost-Palindromic Substring: expand with one skip',
    'leetcode' => 3844,
    'difficulty' => 'Med',
    'summary' => 'Any palindrome of length ≥ 2 is almost-palindromic, and so is a palindrome with one extra character. Expand around every center; at the first mismatch, skip the left or the right character once and keep expanding.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'longest-almost-palindromic-substring',
];
