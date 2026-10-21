<?php
declare(strict_types=1);

return [
    'title' => 'Employee Bonus: left join and keep the nulls',
    'leetcode' => 577,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: left join so employees without a bonus stay, then test bonus < 1000 OR bonus IS NULL. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'employee-bonus',
    'tags' => ['database', 'sql', 'join', 'step-by-step'],
];
