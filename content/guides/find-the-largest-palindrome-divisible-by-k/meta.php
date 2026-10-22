<?php
declare(strict_types=1);

return [
    'title' => 'Find the Largest Palindrome Divisible by K: greedy digits with a feasibility DP',
    'leetcode' => 3260,
    'difficulty' => 'Hard',
    'summary' => 'Choose mirrored digit pairs from the outside in. A DP over (pair index, remainder) says which remainders can still reach 0; take the largest digit that keeps it reachable.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['greedy', 'math', 'string', 'dynamic-programming', 'number-theory', 'leetcode'],
    'related_session' => 'find-the-largest-palindrome-divisible-by-k',
];
