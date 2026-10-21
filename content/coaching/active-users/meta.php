<?php
declare(strict_types=1);

return [
    'title' => 'Active Users: gaps and islands on login dates',
    'leetcode' => 1454,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: deduplicate (id, date), subtract ROW_NUMBER days to get an anchor, group by (id, anchor), and keep groups of the required size. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'active-users',
    'tags' => ['sql', 'database', 'window-functions', 'step-by-step'],
];
