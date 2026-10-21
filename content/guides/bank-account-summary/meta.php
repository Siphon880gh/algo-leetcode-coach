<?php
declare(strict_types=1);

return [
    'title' => 'Bank Account Summary: credit plus net transfers',
    'leetcode' => 1555,
    'difficulty' => 'Med',
    'summary' => 'Unfold transfers into signed rows (−amount for the payer, +amount for the payee), sum per user, add to the starting credit with LEFT JOIN, and label negatives with CASE.',
    'category' => 'LeetCode',
    'subcategory' => 'SQL',
    'topic' => 'LeetCode · SQL',
    'kind' => 'algo',
    'tags' => ['sql', 'database', 'leetcode'],
    'related_session' => 'bank-account-summary',
];
