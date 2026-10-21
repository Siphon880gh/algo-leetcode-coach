<?php
declare(strict_types=1);

return [
    'title' => 'Stone Game VII: score-difference interval DP',
    'leetcode' => 1690,
    'difficulty' => 'Med',
    'summary' => 'Removing an end stone scores the sum of what remains. dp[i][j] = best score difference for the player to move on stones i … j: max(sum(i + 1 … j) − dp[i + 1][j], sum(i … j − 1) − dp[i][j − 1]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'game-theory', 'prefix-sum', 'leetcode'],
    'related_session' => 'stone-game-vii',
];
