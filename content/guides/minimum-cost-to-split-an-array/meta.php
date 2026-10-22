<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Split an Array: DP over the last piece',
    'leetcode' => 2547,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] is the cheapest split of the first i elements. For each end i, grow the last piece leftwards while updating its trimmed length: a value seen for the second time adds 2, and each later copy adds 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'counting', 'leetcode'],
    'related_session' => 'minimum-cost-to-split-an-array',
];
