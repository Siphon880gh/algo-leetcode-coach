<?php
declare(strict_types=1);

return [
    'title' => 'Group Employees of the Same Salary: filter, then dense rank',
    'leetcode' => 1875,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep salaries shared by at least two employees, then DENSE_RANK those salaries for team ids. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'group-employees-of-the-same-salary',
    'tags' => ['sql', 'database', 'window-functions', 'step-by-step'],
];
