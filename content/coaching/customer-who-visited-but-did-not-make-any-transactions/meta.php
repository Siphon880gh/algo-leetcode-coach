<?php
declare(strict_types=1);

return [
    'title' => 'Customer Who Visited but Did Not Make Any Transactions: anti-join',
    'leetcode' => 1581,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: LEFT JOIN Visits to Transactions on visit_id, keep rows where the transaction is NULL, and count per customer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'customer-who-visited-but-did-not-make-any-transactions',
    'tags' => ['sql', 'database', 'step-by-step'],
];
