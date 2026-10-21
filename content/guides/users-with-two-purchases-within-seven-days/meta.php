<?php
declare(strict_types=1);

return [
    'title' => 'Users With Two Purchases Within Seven Days: compare with the previous purchase',
    'leetcode' => 2228,
    'difficulty' => 'Med',
    'summary' => 'For each user, compare each purchase with the previous one by date using LAG. If any gap is at most 7 days, the user qualifies.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'window-functions', 'leetcode'],
    'related_session' => 'users-with-two-purchases-within-seven-days',
];
