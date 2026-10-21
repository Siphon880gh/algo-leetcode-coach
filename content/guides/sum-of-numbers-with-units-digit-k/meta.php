<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Numbers With Units Digit K: at most ten terms',
    'leetcode' => 2310,
    'difficulty' => 'Med',
    'summary' => 'Only the units digit of the sum matters, and it repeats every 10 terms. Return 0 for num = 0; otherwise the smallest c in 1 … 10 with c · k ≤ num and num − c · k divisible by 10, or −1.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['math', 'greedy', 'dynamic-programming', 'enumeration', 'leetcode'],
    'related_session' => 'sum-of-numbers-with-units-digit-k',
];
