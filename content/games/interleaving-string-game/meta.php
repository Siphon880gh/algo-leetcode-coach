<?php
declare(strict_types=1);

return [
    'title' => 'Interleaving String: the next letter of s3 comes from s1 or s2',
    'leetcode' => 97,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j]: can s1[0 to i) and s2[0 to j) form s3[0 to i+j)? True if s1[i−1] == s3[i+j−1] and dp[i−1][j], or s2[j−1] == s3[i+j−1] and dp[i][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'interleaving-string',
    'related_session' => 'interleaving-string',
];
