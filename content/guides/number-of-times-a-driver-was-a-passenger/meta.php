<?php
declare(strict_types=1);

return [
    'title' => 'Number of Times a Driver Was a Passenger: left join on passenger',
    'leetcode' => 2238,
    'difficulty' => 'Med',
    'summary' => 'Take the distinct driver ids and LEFT JOIN Rides on passenger_id = driver_id; COUNT the joined ride ids per driver so drivers never carried count 0.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'number-of-times-a-driver-was-a-passenger',
];
