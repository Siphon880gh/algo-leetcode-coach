<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Transactions Without Negative Balance: undo the worst one',
    'leetcode' => 3711,
    'difficulty' => 'Med',
    'summary' => 'Take every transaction. When the balance drops below 0, drop the most negative transaction taken so far, which a min-heap gives.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'kind' => 'algo',
    'tags' => ['greedy', 'array', 'heap', 'leetcode'],
    'related_session' => 'maximum-transactions-without-negative-balance',
];
