<?php
declare(strict_types=1);

return [
    'title' => 'Find All Anagrams in a String: fixed-size window of letter counts',
    'leetcode' => 438,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: every start index in s where a window of length |p| is an anagram of p. Fixed-size sliding window with 26 letter counts: add the right letter, compare with p, drop the left letter. "cbaebabacd", "abc" → [0,6]. "abab", "ab" → [0,1,2]. Not 76. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'tags' => ['sliding-window', 'hash-table', 'strings', 'step-by-step'],
    'related_guide' => 'find-all-anagrams-in-a-string',
];
