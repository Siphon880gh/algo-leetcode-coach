<?php
declare(strict_types=1);

return [
    'title' => 'Find Kth Bit in Nth Binary String: recurse on the mirror',
    'leetcode' => 1545,
    'difficulty' => 'Med',
    'summary' => 'S_n = S_{n−1} + "1" + reverse(invert(S_{n−1})), length 2^n − 1. The middle is 1; the left half is S_{n−1}; a right-half position mirrors to an inverted bit of S_{n−1}.',
    'category' => 'LeetCode',
    'subcategory' => 'Recursion',
    'topic' => 'LeetCode · Recursion',
    'kind' => 'algo',
    'tags' => ['recursion', 'strings', 'leetcode'],
    'related_session' => 'find-kth-bit-in-nth-binary-string',
];
