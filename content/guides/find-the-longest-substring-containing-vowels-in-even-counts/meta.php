<?php
declare(strict_types=1);

return [
    'title' => 'Find the Longest Substring Containing Vowels in Even Counts: parity mask',
    'leetcode' => 1371,
    'difficulty' => 'Med',
    'summary' => 'Track a 5-bit mask of vowel parities. A substring has all vowel counts even exactly when the mask is the same at both of its ends, so remember the first index of each mask and maximize the distance.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'bit-manipulation', 'hash-map', 'leetcode'],
    'related_session' => 'find-the-longest-substring-containing-vowels-in-even-counts',
];
