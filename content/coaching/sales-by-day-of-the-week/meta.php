<?php
declare(strict_types=1);

return [
    'title' => 'Sales by Day of the Week: pivot by weekday',
    'leetcode' => 1479,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: LEFT JOIN items to orders, SUM(CASE weekday …) per day, GROUP BY category. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'sales-by-day-of-the-week',
    'tags' => ['sql', 'database', 'step-by-step'],
];
