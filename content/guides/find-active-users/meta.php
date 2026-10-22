<?php
declare(strict_types=1);

return [
    'title' => 'Find Active Users: consecutive purchases within 7 days',
    'leetcode' => 2688,
    'difficulty' => 'Med',
    'summary' => 'Sort each user’s purchase dates and compare each with the next one using LEAD. A user is active if some gap is at most 7 days.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'find-active-users',
];
