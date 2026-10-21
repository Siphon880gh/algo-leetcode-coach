<?php
declare(strict_types=1);

return [
    'title' => 'Binary String With Substrings Representing 1 To N: check the top half',
    'leetcode' => 1016,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: only numbers in (n/2, n] need checking, since 2i contains i; if there are more of them than the length of s, return false early. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'String',
    'topic' => 'LeetCode · String',
    'related_guide' => 'binary-string-with-substrings-representing-1-to-n',
    'tags' => ['strings', 'bit-manipulation', 'step-by-step'],
];
