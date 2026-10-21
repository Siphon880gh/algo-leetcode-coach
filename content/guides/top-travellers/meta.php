<?php
declare(strict_types=1);

return [
    'title' => 'Top Travellers: LEFT JOIN with COALESCE',
    'leetcode' => 1407,
    'difficulty' => 'Easy',
    'summary' => 'Every user must appear, with 0 when they have no rides. LEFT JOIN Users to Rides, sum the distance per user with COALESCE, and order by distance descending, then name.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'join', 'aggregation', 'leetcode'],
    'related_session' => 'top-travellers',
];
