<?php
declare(strict_types=1);

return [
    'title' => 'Number of Subarrays With GCD Equal to K: stop when k stops dividing, count only g = k',
    'leetcode' => 2447,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep extending while k divides the running GCD, and count only when it equals k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'number-of-subarrays-with-gcd-equal-to-k',
    'tags' => ['array', 'math', 'number-theory', 'step-by-step'],
];
