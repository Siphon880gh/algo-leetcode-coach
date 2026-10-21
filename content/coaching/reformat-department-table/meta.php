<?php
declare(strict_types=1);

return [
    'title' => 'Reformat Department Table: twelve conditional sums',
    'leetcode' => 1179,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: group by id, and build one SUM(CASE WHEN month = … THEN revenue END) column per month, Jan_Revenue through Dec_Revenue. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'reformat-department-table',
    'tags' => ['database', 'sql', 'pivot', 'step-by-step'],
];
