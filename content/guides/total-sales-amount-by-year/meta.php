<?php
declare(strict_types=1);

return [
    'title' => 'Total Sales Amount by Year: split periods across years',
    'leetcode' => 1384,
    'difficulty' => 'Hard',
    'summary' => 'Generate one row per year (a recursive CTE or a small year list), join each sale to the years it overlaps, and multiply the overlapping day count by the daily average.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'dates', 'recursive-cte', 'leetcode'],
    'related_session' => 'total-sales-amount-by-year',
];
