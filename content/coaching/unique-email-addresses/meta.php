<?php
declare(strict_types=1);

return [
    'title' => 'Unique Email Addresses: normalize the local name',
    'leetcode' => 929,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: split at "@", cut the local name at the first "+", remove its dots, keep the domain as is, and count distinct results. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'unique-email-addresses',
    'tags' => ['hash-table', 'strings', 'step-by-step'],
];
