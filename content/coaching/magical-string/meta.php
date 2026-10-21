<?php
declare(strict_types=1);

return [
    'title' => 'Magical String: the string tells you its own group sizes',
    'leetcode' => 481,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the magical string of 1s and 2s equals its own group lengths. Start from 122, read pointer i = 2: append s[i] copies of the other digit, move i. Count 1s in the first n. n = 6 → 3. n = 1 → 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'tags' => ['two-pointers', 'strings', 'simulation', 'step-by-step'],
    'related_guide' => 'magical-string',
];
