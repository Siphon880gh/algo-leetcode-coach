<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Amount the Robot Can Earn: neutralize up to 2 robbers',
    'leetcode' => 3418,
    'difficulty' => 'Med',
    'summary' => 'dp[r][c][u] = best profit at (r, c) having neutralized u robbers. A negative cell can be taken as is, or neutralized (u + 1 at most 2, adds 0).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-amount-of-money-robot-can-earn',
    'related_session' => 'maximum-amount-of-money-robot-can-earn',
];
