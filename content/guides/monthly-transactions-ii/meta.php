<?php
declare(strict_types=1);

return [
    'title' => 'Monthly Transactions II: approved and chargebacks by their own month',
    'leetcode' => 1205,
    'difficulty' => 'Med',
    'summary' => 'Stack two row sets: approved transactions by their month, and chargebacks joined back to their transaction for country and amount, by the chargeback\'s month. Then group by month and country with conditional counts and sums.',
    'category' => 'LeetCode',
    'subcategory' => 'Database',
    'topic' => 'LeetCode · Database',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'union', 'leetcode'],
    'related_session' => 'monthly-transactions-ii',
];
