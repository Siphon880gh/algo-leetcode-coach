<?php
declare(strict_types=1);

return [
    'title' => 'Reformat Department Table: pivot with conditional sums',
    'leetcode' => 1179,
    'difficulty' => 'Easy',
    'summary' => 'Group by department id and build one column per month with SUM(CASE WHEN month = … THEN revenue END), named Jan_Revenue through Dec_Revenue, so missing months stay NULL.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'pivot', 'leetcode'],
    'related_session' => 'reformat-department-table',
];
