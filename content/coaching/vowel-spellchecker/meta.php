<?php
declare(strict_types=1);

return [
    'title' => 'Vowel Spellchecker: three lookups in order',
    'leetcode' => 966,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: answer each query by exact match, then case-insensitive match, then vowel-insensitive match, keeping the first word in the list for each form. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'vowel-spellchecker',
    'tags' => ['hash-table', 'strings', 'step-by-step'],
];
