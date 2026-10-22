<?php
declare(strict_types=1);

return [
    'title' => 'Customers With Strictly Increasing Purchases: yearly totals, then LAG',
    'leetcode' => 2474,
    'difficulty' => 'Hard',
    'summary' => 'Total each customer’s spending per year. Then compare each year with the previous one using LAG: a customer qualifies when every year follows the last with no gap and with a larger total.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'customers-with-strictly-increasing-purchases',
];
