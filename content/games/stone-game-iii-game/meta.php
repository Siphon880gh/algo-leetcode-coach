<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game III: best lead from each index',
    'leetcode' => 1406,
    'difficulty' => 'Hard',
    'summary' => 'dp[i] = the best (my total − opponent total) from stone i on. Take 1, 2 or 3 stones: sum − dp[i + x]. Alice wins if dp[0] > 0, Bob if < 0, else Tie.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stone-game-iii',
    'related_session' => 'stone-game-iii',
];
