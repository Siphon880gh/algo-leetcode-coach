<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Repeated Subarray: DP on common suffixes',
    'leetcode' => 718,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] is the length of the longest common run ending at nums1[i − 1] and nums2[j − 1]: 1 + the diagonal on a match, 0 otherwise. The answer is the largest entry.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'arrays', 'binary-search', 'rolling-hash', 'leetcode'],
    'related_session' => 'maximum-length-of-repeated-subarray',
];
