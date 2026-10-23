<?php
declare(strict_types=1);

return [
    'title' => 'Find Churn Risk Customers: last event plus history',
    'leetcode' => 3716,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: ROW_NUMBER for the last event, GROUP BY for history. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'find-churn-risk-customers',
    'tags' => ['database', 'step-by-step'],
];
