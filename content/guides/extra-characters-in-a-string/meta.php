<?php
declare(strict_types=1);

return [
    'title' => 'Extra Characters in a String: prefix DP over dictionary words',
    'leetcode' => 2707,
    'difficulty' => 'Med',
    'summary' => 'dp[i] is the fewest leftover characters in the first i letters. Either letter i is extra, or some dictionary word ends at i and dp[i] can take dp[i − len].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'string', 'dynamic-programming', 'trie', 'leetcode'],
    'related_session' => 'extra-characters-in-a-string',
];
