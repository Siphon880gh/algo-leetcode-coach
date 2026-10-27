<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Score Using Exactly K Pairs',
    'leetcode' => 3836,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j][t] = best score using the first i of nums1 and first j of nums2 with t pairs: skip nums1[i−1], skip nums2[j−1], or pair them. Values can be negative, so unreachable states are −∞ and exactly k pairs are required.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-score-using-exactly-k-pairs',
    'related_session' => 'maximum-score-using-exactly-k-pairs',
];
