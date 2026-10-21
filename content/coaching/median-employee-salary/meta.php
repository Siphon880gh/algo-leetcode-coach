<?php
declare(strict_types=1);

return [
    'title' => 'Median Employee Salary: positions inside each company',
    'leetcode' => 569,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: ROW_NUMBER by salary and id, a window COUNT per company, then keep n/2 ≤ rk ≤ n/2 + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'median-employee-salary',
    'tags' => ['database', 'sql', 'window-functions', 'step-by-step'],
];
