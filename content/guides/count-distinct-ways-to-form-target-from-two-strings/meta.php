<?php
declare(strict_types=1);

return [
    'title' => 'Count Distinct Ways to Form Target from Two Strings: DP on both prefixes',
    'leetcode' => 3981,
    'difficulty' => 'Hard',
    'summary' => 'h[a][b] = ways to build the current target prefix using only word1[0 … a − 1] and word2[0 … b − 1]. The next character comes from word1 at some p < a or word2 at some q < b, so two running sums give each layer in O(|word1| · |word2|). Subtract the ways that use only one string.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'prefix-sum', 'leetcode'],
    'related_session' => 'count-distinct-ways-to-form-target-from-two-strings',
];
