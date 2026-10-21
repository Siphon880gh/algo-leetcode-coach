<?php
declare(strict_types=1);

return [
    'title' => 'Find All Anagrams in a String: fixed-size window of letter counts',
    'leetcode' => 438,
    'difficulty' => 'Med',
    'summary' => 'Return every start index in s where a window of length |p| is a permutation of p. Slide a window of exactly |p| over s with 26 letter counts; add the right letter, compare with p, drop the left letter. "cbaebabacd", "abc" → [0,6]. "abab", "ab" → [0,1,2]. Not 76 (min window). Same idea as 567.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['sliding-window', 'hash-table', 'strings', 'leetcode'],
    'related_session' => 'find-all-anagrams-in-a-string',
];
