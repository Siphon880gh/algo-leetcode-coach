<?php
declare(strict_types=1);

return [
    'title' => 'Users That Actively Request Confirmation Messages: pairs within a day',
    'leetcode' => 1939,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: self-join on the same user with a later timestamp, keep gaps within 24 hours, select distinct users. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'users-that-actively-request-confirmation-messages',
    'tags' => ['sql', 'database', 'joins', 'window-functions', 'step-by-step'],
];
