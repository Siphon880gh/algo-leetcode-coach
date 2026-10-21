<?php
declare(strict_types=1);

return [
    'title' => 'Bank Account Summary: signed ledger',
    'leetcode' => 1555,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: UNION ALL payer rows as −amount and payee rows as +amount, sum per user, LEFT JOIN users, CASE on the sign. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'bank-account-summary',
    'tags' => ['sql', 'database', 'step-by-step'],
];
