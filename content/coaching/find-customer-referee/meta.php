<?php
declare(strict_types=1);

return [
    'title' => 'Find Customer Referee: NULL is not != 2',
    'leetcode' => 584,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: referee_id != 2 misses the customers with no referee, so add IS NULL or use a null-safe comparison. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'find-customer-referee',
    'tags' => ['database', 'sql', 'null', 'step-by-step'],
];
