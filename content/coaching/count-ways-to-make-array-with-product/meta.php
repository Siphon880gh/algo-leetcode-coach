<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways to Make Array With Product: stars and bars per prime',
    'leetcode' => 1735,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: factor k; for each prime power p^e multiply by C(n − 1 + e, e); a leftover prime contributes n; reduce mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Combinatorics',
    'topic' => 'LeetCode · Combinatorics',
    'related_guide' => 'count-ways-to-make-array-with-product',
    'tags' => ['math', 'combinatorics', 'number-theory', 'step-by-step'],
];
