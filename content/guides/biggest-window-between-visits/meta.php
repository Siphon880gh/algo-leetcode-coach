<?php
declare(strict_types=1);

return [
    'title' => 'Biggest Window Between Visits: LEAD with an end-date default',
    'leetcode' => 1709,
    'difficulty' => 'Med',
    'summary' => 'Use LEAD(visit_date) per user ordered by date, defaulting to the end date, take DATEDIFF, and keep the maximum per user.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'window-function', 'leetcode'],
    'related_session' => 'biggest-window-between-visits',
];
