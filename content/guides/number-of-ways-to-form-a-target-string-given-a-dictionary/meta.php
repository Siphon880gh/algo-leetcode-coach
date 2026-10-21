<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Form a Target String: column counts DP',
    'leetcode' => 1639,
    'difficulty' => 'Hard',
    'summary' => 'Count each letter per column across all words. dp[i] = ways to build target[:i]; for each column k (left to right), update i from high to low: dp[i + 1] += dp[i] · cnt[k][target[i]].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'string', 'leetcode'],
    'related_session' => 'number-of-ways-to-form-a-target-string-given-a-dictionary',
];
