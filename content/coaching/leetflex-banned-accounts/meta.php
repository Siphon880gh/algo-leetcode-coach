<?php
declare(strict_types=1);

return [
    'title' => 'Leetflex Banned Accounts: overlapping logins from different IPs',
    'leetcode' => 1747,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: self-join the log on the same account and different IPs, keep pairs where one login falls inside the other session, and select distinct accounts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'leetflex-banned-accounts',
    'tags' => ['sql', 'self-join', 'step-by-step'],
];
