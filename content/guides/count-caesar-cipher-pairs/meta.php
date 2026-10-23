<?php
declare(strict_types=1);

return [
    'title' => 'Count Caesar Cipher Pairs: shift every word to start with a',
    'leetcode' => 3805,
    'difficulty' => 'Med',
    'summary' => 'Shifting a whole word keeps the gaps between letters mod 26, so two words are similar exactly when they match after shifting each to start with a. Count equal keys.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'string', 'counting', 'leetcode'],
    'related_session' => 'count-caesar-cipher-pairs',
];
