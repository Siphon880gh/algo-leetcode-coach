<?php
declare(strict_types=1);

return [
    'title' => 'Greatest Sum Divisible by Three: best sum per remainder',
    'leetcode' => 1262,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep dp[r], the largest sum with remainder r, and for each number update every dp[(r + x) mod 3] from a copy of the old values. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'greatest-sum-divisible-by-three',
    'tags' => ['dynamic-programming', 'greedy', 'step-by-step'],
];
