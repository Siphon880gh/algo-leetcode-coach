<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of a Good Subsequence I: at most k value changes',
    'leetcode' => 3176,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = longest good subsequence ending at i using j changes: from p < i with the same value (dp[p][j] + 1) or a different value (dp[p][j−1] + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-the-maximum-length-of-a-good-subsequence-i',
    'related_session' => 'find-the-maximum-length-of-a-good-subsequence-i',
];
