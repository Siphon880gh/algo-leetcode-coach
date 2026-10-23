<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays With K Distinct Integers: two monotone counts',
    'leetcode' => 3859,
    'difficulty' => 'Hard',
    'summary' => 'Let f(lim) count subarrays with at least lim distinct values and at least k values appearing m or more times. Both conditions only grow as the subarray extends left, so a two-pointer pass counts f. The answer is f(k) − f(k + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'counting', 'sliding-window', 'leetcode'],
    'related_session' => 'count-subarrays-with-k-distinct-integers',
];
