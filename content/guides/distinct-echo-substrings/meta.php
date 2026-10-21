<?php
declare(strict_types=1);

return [
    'title' => 'Distinct Echo Substrings: compare halves with hashing',
    'leetcode' => 1316,
    'difficulty' => 'Hard',
    'summary' => 'An echo substring is some a + a. For each half-length L and start i, test whether text[i : i + L] equals text[i + L : i + 2L] in O(1) with a rolling hash (or an LCP table), and collect distinct echoes in a set.',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'hashing', 'leetcode'],
    'related_session' => 'distinct-echo-substrings',
];
