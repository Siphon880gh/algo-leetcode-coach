<?php
declare(strict_types=1);

return [
    'title' => 'Managers with at Least 5 Direct Reports: group, filter, join',
    'leetcode' => 570,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: group rows by managerId, keep groups with HAVING COUNT(*) >= 5, and join back for the names. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'managers-with-at-least-5-direct-reports',
    'tags' => ['database', 'sql', 'group-by', 'step-by-step'],
];
