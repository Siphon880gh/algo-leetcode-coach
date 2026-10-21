<?php
declare(strict_types=1);

return [
    'title' => 'Shopping Offers: memoized search over the needs',
    'leetcode' => 638,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the state is the remaining needs, an offer applies only if it never overshoots, and list price is always an option. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'shopping-offers',
    'tags' => ['dynamic-programming', 'memoization', 'backtracking', 'step-by-step'],
];
