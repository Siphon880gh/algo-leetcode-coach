<?php
declare(strict_types=1);

return [
    'title' => 'Unique Orders and Customers Per Month: filter, then count',
    'leetcode' => 1565,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: WHERE invoice > threshold, GROUP BY year-month, COUNT orders and COUNT DISTINCT customers. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'unique-orders-and-customers-per-month',
    'tags' => ['sql', 'database', 'step-by-step'],
];
