<?php
declare(strict_types=1);

return [
    'title' => 'Percentage of Users Attended a Contest: ratio to all users',
    'leetcode' => 1633,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: group registrations by contest, divide by the total user count, round to 2, order by percentage desc then contest_id. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'percentage-of-users-attended-a-contest',
    'tags' => ['sql', 'database', 'step-by-step'],
];
