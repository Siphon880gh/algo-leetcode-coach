<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Coins for Fruits II: the same DP with a monotonic deque',
    'leetcode' => 2969,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = prices[i] + min dp[j] over j in i+1..2i+1 (0 past the end). The window slides left as i decreases, so a monotonic deque gives each minimum in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-number-of-coins-for-fruits-ii',
    'related_session' => 'minimum-number-of-coins-for-fruits-ii',
];
