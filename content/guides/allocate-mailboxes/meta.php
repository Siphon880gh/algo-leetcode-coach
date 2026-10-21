<?php
declare(strict_types=1);

return [
    'title' => 'Allocate Mailboxes: median cost per group + partition DP',
    'leetcode' => 1478,
    'difficulty' => 'Hard',
    'summary' => 'Sort the houses. One mailbox for a contiguous group is best at the group\'s median; precompute cost[i][j]. Then dp[i][k] partitions houses into k groups.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'math', 'sorting', 'leetcode'],
    'related_session' => 'allocate-mailboxes',
];
