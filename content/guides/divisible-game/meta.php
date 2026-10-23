<?php
declare(strict_types=1);

return [
    'title' => 'Divisible Game: only primes matter',
    'leetcode' => 3984,
    'difficulty' => 'Med',
    'summary' => 'If p divides k, every multiple of k is a multiple of p, so p scores at least as well and is smaller. So try each prime that divides some element, plus the smallest prime that divides none, with Kadane on +x / −x.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'dynamic-programming', 'enumeration', 'number-theory', 'leetcode'],
    'related_session' => 'divisible-game',
];
