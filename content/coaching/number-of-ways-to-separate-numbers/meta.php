<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Separate Numbers: DP with LCP compare',
    'leetcode' => 1977,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: dp over the last number\'s start and length, prefix sums over shorter previous numbers, and an LCP table for equal-length comparisons. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-ways-to-separate-numbers',
    'tags' => ['dynamic-programming', 'string', 'suffix-array', 'step-by-step'],
];
