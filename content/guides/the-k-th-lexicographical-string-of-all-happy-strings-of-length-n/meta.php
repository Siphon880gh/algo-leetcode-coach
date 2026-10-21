<?php
declare(strict_types=1);

return [
    'title' => 'The k-th Lexicographical Happy String of Length n: count blocks',
    'leetcode' => 1415,
    'difficulty' => 'Med',
    'summary' => 'There are 3 · 2^(n − 1) happy strings. Choose letters left to right: after the first letter each position has 2 options, and each option covers a block of 2^(remaining) strings, so k picks the block directly.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'backtracking', 'strings', 'leetcode'],
    'related_session' => 'the-k-th-lexicographical-string-of-all-happy-strings-of-length-n',
];
