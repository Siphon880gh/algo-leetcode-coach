<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Balance Circular Array II',
    'leetcode' => 4004,
    'difficulty' => 'Hard',
    'summary' => 'If the total is negative it is impossible. Otherwise choose a net flow x_i across each edge (i to i+1) so every final balance b_i − x_i + x_{i−1} is at least 0 and the sum of |x_i| is smallest. That is a min-cost flow on the cycle; with n at most 1000 you can push units from donors to the nearest debts along the cheaper side.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-moves-to-balance-circular-array-ii',
    'related_session' => 'minimum-moves-to-balance-circular-array-ii',
];
