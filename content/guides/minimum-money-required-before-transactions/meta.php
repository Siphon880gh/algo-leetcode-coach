<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Money Required Before Transactions: all losses plus the worst last step',
    'leetcode' => 2412,
    'difficulty' => 'Hard',
    'summary' => 'The worst order does every losing transaction first. Add up all their losses, then add the largest of: the cashback of a losing transaction, since the worst case does it last among them, and the cost of any non-losing transaction.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'minimum-money-required-before-transactions',
];
