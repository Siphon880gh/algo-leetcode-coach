<?php
declare(strict_types=1);

return [
    'title' => 'Count Substrings That Satisfy K-Constraint II: left limits and prefix sums',
    'leetcode' => 3261,
    'difficulty' => 'Hard',
    'summary' => 'Let L[j] be the smallest valid start for end j; it never decreases. In a query, ends with L[j] < l can start anywhere from l, and the rest contribute j − L[j] + 1 from a prefix sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'string', 'binary-search', 'prefix-sum', 'sliding-window', 'leetcode'],
    'related_session' => 'count-substrings-that-satisfy-k-constraint-ii',
];
