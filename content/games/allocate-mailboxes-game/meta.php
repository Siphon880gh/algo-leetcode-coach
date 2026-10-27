<?php
declare(strict_types=1);

return [
    'title' => 'Allocate Mailboxes: one mailbox per group, at the median',
    'leetcode' => 1478,
    'difficulty' => 'Hard',
    'summary' => 'Sort houses. cost[i][j] = total distance from houses i to j to their median. dp[b][j] = min over i of dp[b−1][i] + cost[i][j−1].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'allocate-mailboxes',
    'related_session' => 'allocate-mailboxes',
];
