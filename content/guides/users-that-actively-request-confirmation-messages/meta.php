<?php
declare(strict_types=1);

return [
    'title' => 'Users That Actively Request Confirmation Messages: self-join within 24 hours',
    'leetcode' => 1939,
    'difficulty' => 'Easy',
    'summary' => 'Self-join confirmations on the same user with a later timestamp, keep pairs whose gap is within 24 hours, and select distinct users. Only consecutive requests matter, so LEAD() over timestamps works too.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'window-functions', 'leetcode'],
    'related_session' => 'users-that-actively-request-confirmation-messages',
];
