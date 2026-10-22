<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Powerful Integers: count up to N, digit by digit',
    'leetcode' => 2999,
    'difficulty' => 'Hard',
    'summary' => 'Count powerful integers in [1, N] and subtract. For N, walk the free prefix digits: each digit d below N’s digit contributes d · (limit + 1)^(remaining). Stop early if N’s digit exceeds limit, and at the end compare the suffix.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['math', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-the-number-of-powerful-integers',
];
