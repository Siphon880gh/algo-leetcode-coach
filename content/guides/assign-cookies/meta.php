<?php
declare(strict_types=1);

return [
    'title' => 'Assign Cookies: sort both, give each child the smallest cookie that fits',
    'leetcode' => 455,
    'difficulty' => 'Easy',
    'summary' => 'Each child needs a cookie of size ≥ greed; each child gets at most one cookie. Sort greed and sizes. Walk the cookies smallest first; when a cookie fits the least greedy unfed child, feed that child. Count fed children. g [1,2,3], s [1,1] → 1. g [1,2], s [1,2,3] → 2. Not 135.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'sorting', 'two-pointers', 'leetcode'],
    'related_session' => 'assign-cookies',
];
