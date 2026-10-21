<?php
declare(strict_types=1);

return [
    'title' => 'Monthly Transactions II: two event streams',
    'leetcode' => 1205,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: take approved transactions by their month, union chargebacks joined to their transaction by the chargeback month, then group with conditional counts and sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'related_guide' => 'monthly-transactions-ii',
    'tags' => ['database', 'sql', 'union', 'step-by-step'],
];
