<?php
declare(strict_types=1);

return [
    'title' => 'Number of Distinct Roll Sequences: two-roll state, gcd with the last',
    'leetcode' => 2318,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep the last two rolls, return 6 for n = 1, and test gcd against the last roll. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-distinct-roll-sequences',
    'tags' => ['dynamic-programming', 'memoization', 'step-by-step'],
];
