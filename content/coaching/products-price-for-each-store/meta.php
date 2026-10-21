<?php
declare(strict_types=1);

return [
    'title' => 'Product\'s Price for Each Store: pivot with conditional aggregation',
    'leetcode' => 1777,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: GROUP BY product and, per store, MAX(CASE WHEN store = that store THEN price END), leaving absent stores NULL. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'related_guide' => 'products-price-for-each-store',
    'tags' => ['sql', 'pivot', 'step-by-step'],
];
