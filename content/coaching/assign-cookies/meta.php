<?php
declare(strict_types=1);

return [
    'title' => 'Assign Cookies: sort both, give each child the smallest cookie that fits',
    'leetcode' => 455,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: each child needs a cookie of size ≥ greed; one cookie per child. Sort both; give each child, least greedy first, the smallest cookie that fits; skip cookies that are too small. g [1,2,3], s [1,1] → 1. g [1,2], s [1,2,3] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'tags' => ['greedy', 'sorting', 'two-pointers', 'step-by-step'],
    'related_guide' => 'assign-cookies',
];
