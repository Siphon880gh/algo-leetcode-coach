<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Cut a Stick: interval DP over cut points',
    'leetcode' => 1547,
    'difficulty' => 'Hard',
    'summary' => 'Sort cuts and add 0 and n. dp[i][j] = cheapest way to make every cut strictly between points i and j = (p[j] − p[i]) + min over m of dp[i][m] + dp[m][j].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-cut-a-stick',
    'related_session' => 'minimum-cost-to-cut-a-stick',
];
