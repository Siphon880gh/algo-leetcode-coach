<?php
declare(strict_types=1);

return [
    'title' => 'Find the Longest Substring Containing Vowels in Even Counts: equal masks',
    'leetcode' => 1371,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a 5-bit vowel parity mask, store its first index, and maximize i − first[mask]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'find-the-longest-substring-containing-vowels-in-even-counts',
    'tags' => ['prefix-sum', 'bit-manipulation', 'hash-map', 'step-by-step'],
];
