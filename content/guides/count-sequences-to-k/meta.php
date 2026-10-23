<?php
declare(strict_types=1);

return [
    'title' => 'Count Sequences to K: DP over prime exponents',
    'leetcode' => 3850,
    'difficulty' => 'Hard',
    'summary' => 'Every nums[i] ≤ 6 factors into 2, 3 and 5, so val is 2^a · 3^b · 5^c. If k has another prime factor, the answer is 0. Otherwise count choices with a dictionary over (a, b, c).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['memoization', 'array', 'math', 'dynamic-programming', 'number-theory', 'leetcode'],
    'related_session' => 'count-sequences-to-k',
];
