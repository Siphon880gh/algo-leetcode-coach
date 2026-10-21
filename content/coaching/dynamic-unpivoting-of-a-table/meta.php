<?php
declare(strict_types=1);

return [
    'title' => 'Dynamic Unpivoting of a Table: one SELECT per store column',
    'leetcode' => 2253,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: read the store columns from the schema, skip product_id, and keep only non-null prices. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'dynamic-unpivoting-of-a-table',
    'tags' => ['database', 'sql', 'step-by-step'],
];
