<?php
declare(strict_types=1);

return [
    'title' => 'Non-negative Integers without Consecutive Ones: Fibonacci tails',
    'leetcode' => 600,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: k-bit strings with no 11 number f[k] (Fibonacci); walk n from the top bit, add f[i] at each 1, and stop at a second 1 in a row. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'non-negative-integers-without-consecutive-ones',
    'tags' => ['dynamic-programming', 'bit-manipulation', 'digit-dp', 'step-by-step'],
];
