<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Transaction Each Day: rank within each date',
    'leetcode' => 1831,
    'difficulty' => 'Med',
    'summary' => 'Partition by the date part of the timestamp, rank by amount descending, and keep rank 1 (RANK keeps ties). A join with per-day MAX works too.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'window-function', 'leetcode'],
    'related_session' => 'maximum-transaction-each-day',
];
