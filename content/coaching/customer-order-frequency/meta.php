<?php
declare(strict_types=1);

return [
    'title' => 'Customer Order Frequency: HAVING per month',
    'leetcode' => 1511,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: join orders to products, group by customer, and require each month\'s SUM(CASE … price × quantity) to meet the bar in HAVING. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'customer-order-frequency',
    'tags' => ['sql', 'database', 'step-by-step'],
];
