<?php
declare(strict_types=1);

return [
    'title' => 'Distribute Repeating Integers: submask DP',
    'leetcode' => 1655,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: keep only value counts; f(i, mask) tries every submask of unsatisfied customers that value i can cover. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'distribute-repeating-integers',
    'tags' => ['dynamic-programming', 'bitmask', 'backtracking', 'step-by-step'],
];
