<?php
declare(strict_types=1);

return [
    'title' => 'Invalid Transactions: two rules per transaction',
    'leetcode' => 1169,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: parse each record, mark it if the amount is over 1000, and compare it with others of the same name for a different city within 60 minutes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'invalid-transactions',
    'tags' => ['hash-table', 'strings', 'sorting', 'step-by-step'],
];
