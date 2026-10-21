<?php
declare(strict_types=1);

return [
    'title' => 'Count Different Palindromic Subsequences: interval DP with the same outer letter',
    'leetcode' => 730,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] counts distinct palindromic subsequences in s[i..j]. When the ends match, double the inner count and correct for repeats of that letter inside, using the first and last inner occurrences. When they differ, use inclusion-exclusion.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'count-different-palindromic-subsequences',
];
