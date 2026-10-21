<?php
declare(strict_types=1);

return [
    'title' => 'Sales by Day of the Week: pivot with conditional sums',
    'leetcode' => 1479,
    'difficulty' => 'Hard',
    'summary' => 'LEFT JOIN items to orders so every category appears, then pivot with one SUM(CASE WHEN weekday = d THEN quantity ELSE 0 END) per day.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'leetcode'],
    'related_session' => 'sales-by-day-of-the-week',
];
