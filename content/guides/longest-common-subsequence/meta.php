<?php
declare(strict_types=1);

return [
    'title' => 'Longest Common Subsequence: the classic table',
    'leetcode' => 1143,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] is the LCS of the first i letters of text1 and the first j of text2. Equal last letters extend the diagonal; otherwise drop one letter from either side and keep the better result.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'longest-common-subsequence',
];
