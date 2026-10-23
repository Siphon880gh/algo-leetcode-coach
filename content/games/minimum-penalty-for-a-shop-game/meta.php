<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Penalty for a Shop',
    'leetcode' => 2483,
    'difficulty' => 'Med',
    'summary' => 'Closing at hour j costs (N before j) + (Y from j on). Start with penalty = #Y (close at 0) and update as j moves: Y → −1, N → +1. Return the earliest minimum.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'tags' => ['prefix-sum', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-penalty-for-a-shop',
    'related_session' => 'minimum-penalty-for-a-shop',
];
