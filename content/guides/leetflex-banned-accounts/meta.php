<?php
declare(strict_types=1);

return [
    'title' => 'Leetflex Banned Accounts: overlapping logins from different IPs',
    'leetcode' => 1747,
    'difficulty' => 'Med',
    'summary' => 'Self-join the log on the same account and different IPs, keep pairs where one session starts within the other, and select distinct accounts.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'self-join', 'leetcode'],
    'related_session' => 'leetflex-banned-accounts',
];
