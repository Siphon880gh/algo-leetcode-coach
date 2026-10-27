<?php
declare(strict_types=1);

return [
    'title' => 'Knight Dialer',
    'leetcode' => 935,
    'difficulty' => 'Med',
    'summary' => 'dp[d] = numbers of the current length ending at digit d. Each step, dp\'[d] = the sum of dp[from] over digits a knight jump away. Sum after n − 1 steps, mod 1e9 + 7.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'knight-dialer',
    'related_session' => 'knight-dialer',
];
