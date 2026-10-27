<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost to Reach Destination in Time',
    'leetcode' => 1928,
    'difficulty' => 'Hard',
    'summary' => 'dp[t][v] = cheapest fees to stand at v at exactly time t. Relax every road for every time at most maxTime; answer = min over t of dp[t][n − 1].',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-to-reach-destination-in-time',
    'related_session' => 'minimum-cost-to-reach-destination-in-time',
];
