<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VII: score the remaining sum',
    'leetcode' => 1690,
    'difficulty' => 'Med',
    'summary' => 'dp[i][j] = best difference for the player to move on stones i..j. Removing the left stone scores sum(i+1..j); removing the right scores sum(i..j−1). Subtract the opponent\'s dp after the move.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'stone-game-vii',
    'related_session' => 'stone-game-vii',
];
