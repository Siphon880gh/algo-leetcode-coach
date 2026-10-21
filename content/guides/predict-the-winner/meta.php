<?php
declare(strict_types=1);

return [
    'title' => 'Predict the Winner: interval DP on score difference',
    'leetcode' => 486,
    'difficulty' => 'Med',
    'summary' => 'Players alternately take a number from either end; player 1 wins on ties. f[i][j] = best (current player − other player) on nums[i..j]. f[i][j] = max(nums[i] − f[i+1][j], nums[j] − f[i][j−1]). Player 1 wins if f[0][n−1] ≥ 0. [1,5,2] → false. [1,5,233,7] → true. Same as 877 without its shortcut.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'game-theory', 'interval-dp', 'leetcode'],
    'related_session' => 'predict-the-winner',
];
