<?php
declare(strict_types=1);

return [
    'title' => 'Greatest Sum Divisible by Three: best sum per remainder',
    'leetcode' => 1262,
    'difficulty' => 'Med',
    'summary' => 'Keep dp[r], the largest sum with remainder r mod 3. Each number can extend any state, so update all three from a copy of the old values; dp[0] is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'greedy', 'leetcode'],
    'related_session' => 'greatest-sum-divisible-by-three',
];
