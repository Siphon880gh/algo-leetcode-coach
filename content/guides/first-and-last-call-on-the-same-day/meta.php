<?php
declare(strict_types=1);

return [
    'title' => 'First and Last Call On the Same Day: rank calls per user and day',
    'leetcode' => 1972,
    'difficulty' => 'Hard',
    'summary' => 'Unpivot calls into (user, other, time) in both directions. Per user and day, find the other party of the earliest and the latest call (ROW_NUMBER ascending and descending) and keep users where they match on some day.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'window-functions', 'leetcode'],
    'related_session' => 'first-and-last-call-on-the-same-day',
];
