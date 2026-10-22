<?php
declare(strict_types=1);

return [
    'title' => 'Consecutive Transactions with Increasing Amounts: gaps and islands',
    'leetcode' => 2701,
    'difficulty' => 'Hard',
    'summary' => 'Compare each row with the customer’s previous row: a new stretch starts unless the date is the next day and the amount is higher. A running sum of those starts labels the stretches; group by it and keep the long ones.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['database', 'sql', 'leetcode'],
    'related_session' => 'consecutive-transactions-with-increasing-amounts',
];
