<?php
declare(strict_types=1);

return [
    'title' => 'Decrypt String from Alphabet to Integer Mapping: look ahead for #',
    'leetcode' => 1309,
    'difficulty' => 'Easy',
    'summary' => 'Scan left to right. If the character two positions ahead is #, read two digits as 10–26 (j–z) and skip three; otherwise read one digit as 1–9 (a–i).',
    'category' => 'LeetCode',
    'subcategory' => 'Strings',
    'topic' => 'LeetCode · Strings',
    'kind' => 'algo',
    'tags' => ['strings', 'leetcode'],
    'related_session' => 'decrypt-string-from-alphabet-to-integer-mapping',
];
