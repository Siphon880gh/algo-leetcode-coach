<?php
declare(strict_types=1);

return [
    'title' => 'Sequential Digits: substrings of "123456789"',
    'leetcode' => 1291,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: every candidate is a substring of "123456789", so generate them by length and then start, keeping those within [low, high]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Enumeration',
    'topic' => 'LeetCode · Enumeration',
    'related_guide' => 'sequential-digits',
    'tags' => ['enumeration', 'step-by-step'],
];
