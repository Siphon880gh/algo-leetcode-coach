<?php
declare(strict_types=1);

return [
    'title' => 'Calculate Money in Leetcode Bank: arithmetic by week',
    'leetcode' => 1716,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: full weeks w = n // 7 give 28w + 7 · w(w − 1)/2; the d = n % 7 leftover days give d(w + 1) + d(d − 1)/2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'calculate-money-in-leetcode-bank',
    'tags' => ['math', 'simulation', 'step-by-step'],
];
