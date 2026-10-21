<?php
declare(strict_types=1);

return [
    'title' => 'Orders With Maximum Quantity Above Average: compare to the largest average',
    'leetcode' => 1867,
    'difficulty' => 'Med',
    'summary' => 'Aggregate once per order to get its max and average quantity. "Above every average" means above the largest average, so compare each order\'s max to MAX(avg) over all orders.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'aggregation', 'leetcode'],
    'related_session' => 'orders-with-maximum-quantity-above-average',
];
