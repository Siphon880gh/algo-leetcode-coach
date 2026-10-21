<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game V: interval DP over split points',
    'leetcode' => 1563,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = best Alice can score on stones i..j. Try every split; the smaller-sum side is kept (its sum is scored); on a tie Alice may keep either side.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'interval-dp', 'game-theory', 'leetcode'],
    'related_session' => 'stone-game-v',
];
