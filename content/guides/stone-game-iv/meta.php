<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game IV: win if some square move reaches a losing state',
    'leetcode' => 1510,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] is true when the player to move with i stones can win: some square j² ≤ i makes dp[i − j²] false.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dp', 'game-theory', 'math', 'leetcode'],
    'related_session' => 'stone-game-iv',
];
