<?php
declare(strict_types=1);

return [
    'title' => 'Employee Bonus: left join and keep the missing bonuses',
    'leetcode' => 577,
    'difficulty' => 'Easy',
    'summary' => 'Left join Employee to Bonus so employees without a bonus stay, then keep rows where bonus < 1000 or bonus is null.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'join', 'leetcode'],
    'related_session' => 'employee-bonus',
];
