<?php
declare(strict_types=1);

return [
    'title' => 'Account Balance: running sum per account',
    'leetcode' => 2066,
    'difficulty' => 'Med',
    'summary' => 'Map each row to a signed amount (+ for deposits, − for withdrawals) and take SUM(...) OVER (PARTITION BY account ORDER BY day).',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'window-functions', 'leetcode'],
    'related_session' => 'account-balance',
];
