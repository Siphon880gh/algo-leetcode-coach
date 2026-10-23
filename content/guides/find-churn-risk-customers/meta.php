<?php
declare(strict_types=1);

return [
    'title' => 'Find Churn Risk Customers: last event plus history',
    'leetcode' => 3716,
    'difficulty' => 'Med',
    'summary' => 'Take each user’s last event with ROW_NUMBER, and their history (maximum amount, downgrades, days from first to last event) with GROUP BY. Then filter.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-churn-risk-customers',
];
