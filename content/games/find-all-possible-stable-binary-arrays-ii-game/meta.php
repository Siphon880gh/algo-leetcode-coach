<?php
declare(strict_types=1);

return [
    'title' => 'Stable Binary Arrays II: the same DP, bigger limits',
    'leetcode' => 3130,
    'difficulty' => 'Hard',
    'summary' => 'dp[z][o][last] with the run-length correction term: dp[z][o][0] = dp[z−1][o][0] + dp[z−1][o][1] − dp[z−limit−1][o][1] (and symmetrically for 1). O(zero times one).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-all-possible-stable-binary-arrays-ii',
    'related_session' => 'find-all-possible-stable-binary-arrays-ii',
];
