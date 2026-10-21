<?php
declare(strict_types=1);

return [
    'title' => 'Magical String: the string tells you its own group sizes',
    'leetcode' => 481,
    'difficulty' => 'Med',
    'summary' => 'The magical string of 1s and 2s equals the sequence of its own group lengths: 1 22 11 2 1 22 … Build it from "122" with a read pointer i at index 2: append s[i] copies of the digit that differs from the last one, then move i. Count 1s in the first n characters. n = 6 → 3. n = 1 → 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'strings', 'simulation', 'leetcode'],
    'related_session' => 'magical-string',
];
