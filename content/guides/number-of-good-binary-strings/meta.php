<?php
declare(strict_types=1);

return [
    'title' => 'Number of Good Binary Strings: blocks of fixed sizes',
    'leetcode' => 2533,
    'difficulty' => 'Med',
    'summary' => 'A good string splits uniquely into chunks of exactly the 1-group size of 1s and the 0-group size of 0s. So dp[i] = dp[i − oneGroup] + dp[i − zeroGroup], and the answer sums dp over the allowed lengths.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'number-of-good-binary-strings',
];
