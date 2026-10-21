<?php
declare(strict_types=1);

return [
    'title' => 'Longest Ideal Subsequence: best length ending in each letter',
    'leetcode' => 2370,
    'difficulty' => 'Med',
    'summary' => 'Keep dp[c], the longest ideal subsequence so far ending with letter c. For each character, extend the best dp over letters within k of it, so each step looks at no more than 2k + 1 letters.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['hash-table', 'string', 'dynamic-programming', 'leetcode'],
    'related_session' => 'longest-ideal-subsequence',
];
