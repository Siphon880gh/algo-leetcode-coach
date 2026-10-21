<?php
declare(strict_types=1);

return [
    'title' => 'Total Sales Amount by Year: per-year overlap',
    'leetcode' => 1384,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: generate the years, join each sale to the years it overlaps, and multiply the overlapping day count by the daily average. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'total-sales-amount-by-year',
    'tags' => ['sql', 'dates', 'recursive-cte', 'step-by-step'],
];
