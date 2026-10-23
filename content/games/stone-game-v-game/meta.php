<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game V: Bob throws away the bigger half',
    'leetcode' => 1563,
    'difficulty' => 'Hard',
    'summary' => 'dp[i][j] = Alice\'s best from row i..j. For each split, the smaller-sum side is kept (its sum is scored and play continues on it); on a tie Alice picks the better side.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stone-game-v',
    'related_session' => 'stone-game-v',
];
