<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Days to Eat N Oranges: memoised divide',
    'leetcode' => 1553,
    'difficulty' => 'Hard',
    'summary' => 'Eating one at a time is only useful to reach a multiple of 2 or 3. So f(n) = 1 + min(n mod 2 + f(n / 2), n mod 3 + f(n / 3)), memoised; only O(log² n) states appear.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'memoization', 'leetcode'],
    'related_session' => 'minimum-number-of-days-to-eat-n-oranges',
];
