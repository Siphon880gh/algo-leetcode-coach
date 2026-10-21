<?php
declare(strict_types=1);

return [
    'title' => 'Invalid Transactions: amount check plus pairwise city check',
    'leetcode' => 1169,
    'difficulty' => 'Med',
    'summary' => 'Parse every transaction. It is invalid if its amount exceeds 1000, or if another transaction with the same name in a different city is within 60 minutes inclusive; n ≤ 1000, so comparing pairs per name is fine.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'kind' => 'algo',
    'tags' => ['hash-table', 'strings', 'sorting', 'leetcode'],
    'related_session' => 'invalid-transactions',
];
