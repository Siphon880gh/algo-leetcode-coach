<?php
declare(strict_types=1);

return [
    'title' => 'Fibonacci Number: iterate with two variables',
    'leetcode' => 509,
    'difficulty' => 'Easy',
    'summary' => 'F(0) = 0, F(1) = 1, F(n) = F(n − 1) + F(n − 2). Keep a, b = 0, 1 and repeat a, b = b, a + b n times; return a. Plain recursion recomputes subproblems exponentially. n = 4 → 3. Same pattern as 70.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'math', 'recursion', 'leetcode'],
    'related_session' => 'fibonacci-number',
];
