<?php
declare(strict_types=1);

return [
    'title' => 'Subsequences With min + max ≤ target: sort and pair',
    'leetcode' => 1498,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort; for each l with a[l] + a[r] ≤ target, add 2^(r − l) and move l; else move r. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'related_guide' => 'number-of-subsequences-that-satisfy-the-given-sum-condition',
    'tags' => ['two-pointers', 'sorting', 'math', 'step-by-step'],
];
