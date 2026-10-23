<?php
declare(strict_types=1);

return [
    'title' => 'Longest Repeating Substring: common suffixes of two prefixes',
    'leetcode' => 1062,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] (i < j) = length of the common run ending at s[i−1] and s[j−1]. Equal letters extend the diagonal. The answer is the largest dp.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'longest-repeating-substring',
    'related_session' => 'longest-repeating-substring',
];
