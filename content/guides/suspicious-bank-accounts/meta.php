<?php
declare(strict_types=1);

return [
    'title' => 'Suspicious Bank Accounts: over-limit months back to back',
    'leetcode' => 1843,
    'difficulty' => 'Med',
    'summary' => 'Aggregate incoming amounts per account and month, keep months above the limit, then self-join on the same account with the month index one greater.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'group-by', 'self-join', 'leetcode'],
    'related_session' => 'suspicious-bank-accounts',
];
