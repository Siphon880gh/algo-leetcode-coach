<?php
declare(strict_types=1);

return [
    'title' => 'Confirmation Rate: LEFT JOIN and average a condition',
    'leetcode' => 1934,
    'difficulty' => 'Med',
    'summary' => 'Left-join Signups to Confirmations so users without requests survive; the rate is AVG of (action = \'confirmed\'), with NULL turned into 0, rounded to two decimals.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'joins', 'leetcode'],
    'related_session' => 'confirmation-rate',
];
