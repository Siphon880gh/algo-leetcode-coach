<?php
declare(strict_types=1);

return [
    'title' => 'Stable Binary Arrays I: no run longer than limit',
    'leetcode' => 3129,
    'difficulty' => 'Med',
    'summary' => 'dp[z][o][last] = arrays with z zeros and o ones ending in last. Appending last again extends its run; subtract the arrays where the run would exceed limit: dp[z][o][0] = dp[z−1][o][0] + dp[z−1][o][1] − dp[z−limit−1][o][1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-all-possible-stable-binary-arrays-i',
    'related_session' => 'find-all-possible-stable-binary-arrays-i',
];
