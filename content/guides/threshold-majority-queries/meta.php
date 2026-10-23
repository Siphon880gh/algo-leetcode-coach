<?php
declare(strict_types=1);

return [
    'title' => 'Threshold Majority Queries: Mo’s algorithm with rollback',
    'leetcode' => 3636,
    'difficulty' => 'Hard',
    'summary' => 'Answer the queries offline with Mo’s algorithm. Adding an element can only raise the best (frequency, smallest value), but removing one cannot be undone cheaply, so keep a right part that only grows and add the left part fresh for each query, rolling it back afterwards.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'binary-search', 'divide-and-conquer', 'counting', 'prefix-sum', 'leetcode'],
    'related_session' => 'threshold-majority-queries',
];
