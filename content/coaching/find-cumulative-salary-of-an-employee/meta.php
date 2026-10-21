<?php
declare(strict_types=1);

return [
    'title' => 'Find Cumulative Salary of an Employee: a three-month RANGE window',
    'leetcode' => 579,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sum by calendar month with RANGE 2 PRECEDING, drop each employee\'s latest month, and order by id, then month descending. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'find-cumulative-salary-of-an-employee',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
];
