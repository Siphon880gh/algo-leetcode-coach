<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Ideal Arrays: divisor chains',
    'leetcode' => 2338,
    'difficulty' => 'Hard',
    'summary' => 'dp[len][v] = ideal arrays of length len ending in v = Σ dp[len−1][d] over divisors d of v. (The fast version counts strictly increasing chains and spreads them with combinations.)',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-the-number-of-ideal-arrays',
    'related_session' => 'count-the-number-of-ideal-arrays',
];
