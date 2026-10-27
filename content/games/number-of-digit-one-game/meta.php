<?php
declare(strict_types=1);

return [
    'title' => 'Number of Digit One: count ones place by place',
    'leetcode' => 233,
    'difficulty' => 'Hard',
    'summary' => 'For each place value p (1, 10, 100, …): high = n divided by (10p), cur = (n divided by p) % 10, low = n % p. Ones there: high times p, plus p if cur > 1, plus low + 1 if cur == 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-digit-one',
    'related_session' => 'number-of-digit-one',
];
