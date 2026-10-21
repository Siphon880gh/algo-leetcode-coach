<?php
declare(strict_types=1);

return [
    'title' => 'Orders With Maximum Quantity Above Average: compare to MAX(avg)',
    'leetcode' => 1867,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: per order compute MAX and AVG quantity, then keep orders whose max beats the largest average. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'orders-with-maximum-quantity-above-average',
    'tags' => ['sql', 'database', 'aggregation', 'step-by-step'],
];
