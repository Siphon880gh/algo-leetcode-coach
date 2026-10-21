<?php
declare(strict_types=1);

return [
    'title' => 'Restore The Array: DP over number boundaries',
    'leetcode' => 1416,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] counts ways to split s[i:] into numbers in [1, k] with no leading zeros. From i (not a 0), extend j while s[i..j] ≤ k, adding dp[j + 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'restore-the-array',
];
