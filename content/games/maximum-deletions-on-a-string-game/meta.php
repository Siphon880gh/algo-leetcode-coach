<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Deletions on a String: delete a repeated prefix',
    'leetcode' => 2430,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = most operations on suffix s[i..]. If s[i to i+j) equals s[i+j to i+2j), you can delete it: 1 + dp[i+j]. Otherwise delete everything: 1. (An LCP table makes the comparison O(1).)',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-deletions-on-a-string',
    'related_session' => 'maximum-deletions-on-a-string',
];
