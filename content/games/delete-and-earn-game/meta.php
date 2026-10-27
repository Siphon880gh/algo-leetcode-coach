<?php
declare(strict_types=1);

return [
    'title' => 'Delete and Earn: House Robber over values',
    'leetcode' => 740,
    'difficulty' => 'Med',
    'summary' => 'Total points per value: pts[v] = v times count(v). Taking v forbids v−1 and v+1, so dp[v] = max(dp[v−1], dp[v−2] + pts[v]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'delete-and-earn',
    'related_session' => 'delete-and-earn',
];
