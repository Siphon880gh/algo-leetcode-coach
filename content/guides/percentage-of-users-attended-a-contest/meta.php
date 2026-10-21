<?php
declare(strict_types=1);

return [
    'title' => 'Percentage of Users Attended a Contest: count over total',
    'leetcode' => 1633,
    'difficulty' => 'Easy',
    'summary' => 'Group Register by contest_id; percentage = ROUND(100 · COUNT(user_id) / (SELECT COUNT(*) FROM Users), 2). Order by percentage DESC, contest_id ASC.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'leetcode'],
    'related_session' => 'percentage-of-users-attended-a-contest',
];
