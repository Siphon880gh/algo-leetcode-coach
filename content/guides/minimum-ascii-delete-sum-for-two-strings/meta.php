<?php
declare(strict_types=1);

return [
    'title' => 'Minimum ASCII Delete Sum for Two Strings: an LCS weighted by ASCII',
    'leetcode' => 712,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] is the cheapest deletion cost to make the suffixes s1[i:] and s2[j:] equal: keep matching characters for free, otherwise delete one side\'s character at its ASCII cost.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'strings', 'leetcode'],
    'related_session' => 'minimum-ascii-delete-sum-for-two-strings',
];
