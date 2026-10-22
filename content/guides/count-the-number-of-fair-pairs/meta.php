<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Fair Pairs: at most upper minus at most lower − 1',
    'leetcode' => 2563,
    'difficulty' => 'Med',
    'summary' => 'Order does not matter for a pair count, so sort. Count pairs with sum ≤ x by two pointers, and return count(upper) − count(lower − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'count-the-number-of-fair-pairs',
];
