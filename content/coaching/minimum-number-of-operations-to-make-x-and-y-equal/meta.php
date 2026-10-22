<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Make X and Y Equal: compare every route',
    'leetcode' => 2998,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: memoize over x, trying x − y and moving to a nearby multiple of 5 or 11. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-number-of-operations-to-make-x-and-y-equal',
    'tags' => ['breadth-first-search', 'memoization', 'dynamic-programming', 'step-by-step'],
];
