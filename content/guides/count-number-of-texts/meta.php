<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Texts: DP over runs of equal keys',
    'leetcode' => 2266,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = number of messages for the first i presses. The last letter uses 1 to 3 presses of the same key (up to 4 for keys 7 and 9), all equal to pressedKeys[i − 1]; add those dp values mod 10^9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['hash-table', 'math', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'count-number-of-texts',
];
