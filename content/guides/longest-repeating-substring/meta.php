<?php
declare(strict_types=1);

return [
    'title' => 'Longest Repeating Substring: DP on matching suffixes',
    'leetcode' => 1062,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] is the length of the common substring ending at positions i and j. When s[i] equals s[j], it extends dp[i − 1][j − 1]. The largest value over i < j is the answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'binary-search', 'rolling-hash', 'leetcode'],
    'related_session' => 'longest-repeating-substring',
];
