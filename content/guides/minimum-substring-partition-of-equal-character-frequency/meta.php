<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Substring Partition of Equal Character Frequency: DP over the last piece',
    'leetcode' => 3144,
    'difficulty' => 'Med',
    'summary' => 'dp[i] = fewest balanced pieces for the first i characters. Grow the last piece leftwards from i, tracking distinct letters and the top count; it is balanced when top · distinct equals its length.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'counting', 'leetcode'],
    'related_session' => 'minimum-substring-partition-of-equal-character-frequency',
];
