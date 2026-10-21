<?php
declare(strict_types=1);

return [
    'title' => 'Predict the Winner: interval DP on score difference',
    'leetcode' => 486,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: players take from either end; does player 1 end with at least player 2? f[i][j] = best lead for the player to move on nums[i..j] = max(nums[i] − f[i + 1][j], nums[j] − f[i][j − 1]). Win if f[0][n − 1] ≥ 0. [1,5,2] → false. [1,5,233,7] → true. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'game-theory', 'interval-dp', 'step-by-step'],
    'related_guide' => 'predict-the-winner',
];
