<?php
declare(strict_types=1);

return [
    'title' => 'Suspicious Bank Accounts: consecutive over-limit months',
    'leetcode' => 1843,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sum incoming per account and month, keep those over the limit, self-join on the next month index. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'suspicious-bank-accounts',
    'tags' => ['sql', 'group-by', 'self-join', 'step-by-step'],
];
