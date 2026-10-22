<?php
declare(strict_types=1);

return [
    'title' => 'Find Top Performing Driver: aggregate per driver and fuel, then rank',
    'leetcode' => 3308,
    'difficulty' => 'Med',
    'summary' => 'Join trips to vehicles, aggregate per (fuel, driver) into the rounded average rating and total distance, join drivers, and keep ROW_NUMBER 1 per fuel type.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'leetcode'],
    'related_session' => 'find-top-performing-driver',
];
