<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Deletions on a String: DP on suffixes with an LCP table',
    'leetcode' => 2430,
    'difficulty' => 'Hard',
    'summary' => 'Let dp[i] be the most operations for the suffix starting at i. Deleting the first j letters is allowed when the suffix’s first j letters repeat right after, which a longest-common-prefix table answers in O(1); dp[i] is 1 or the best 1 + dp[i + j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['string', 'dynamic-programming', 'string-matching', 'hash-function', 'rolling-hash', 'leetcode'],
    'related_session' => 'maximum-deletions-on-a-string',
];
