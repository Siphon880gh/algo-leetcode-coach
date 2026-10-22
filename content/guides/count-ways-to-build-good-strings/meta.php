<?php
declare(strict_types=1);

return [
    'title' => 'Count Ways To Build Good Strings: DP on length',
    'leetcode' => 2466,
    'difficulty' => 'Med',
    'summary' => 'Only lengths matter: a string of length L ends with a block of zeros or a block of ones. dp[L] = dp[L − zero] + dp[L − one], and the answer sums dp over low … high.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'count-ways-to-build-good-strings',
];
