<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Days to Eat N Oranges: eat singles only to reach a multiple',
    'leetcode' => 1553,
    'difficulty' => 'Hard',
    'summary' => 'f(n) = 1 + min(n % 2 + f(n divided by 2), n % 3 + f(n divided by 3)) (floor division), with f(0) = 0 and f(1) = 1. Eating one at a time is only useful to reach a multiple of 2 or 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-days-to-eat-n-oranges',
    'related_session' => 'minimum-number-of-days-to-eat-n-oranges',
];
