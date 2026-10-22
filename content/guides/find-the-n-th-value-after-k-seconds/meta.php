<?php
declare(strict_types=1);

return [
    'title' => 'Find the N-th Value After K Seconds: binomial or prefix sums',
    'leetcode' => 3179,
    'difficulty' => 'Med',
    'summary' => 'Each second takes prefix sums, so a[n − 1] after k seconds is C(n − 1 + k, k). Simulating is also fine at 10^6 steps.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'combinatorics', 'prefix-sum', 'simulation', 'leetcode'],
    'related_session' => 'find-the-n-th-value-after-k-seconds',
];
