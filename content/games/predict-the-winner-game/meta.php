<?php
declare(strict_types=1);

return [
    'title' => 'Predict the Winner: best lead the mover can force',
    'leetcode' => 486,
    'difficulty' => 'Med',
    'summary' => 'dp[l][r] = the lead the player to move can force on nums[l to r]: max(nums[l] − dp[l+1][r], nums[r] − dp[l][r−1]). Player 1 wins if dp[0][n−1] at least 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'predict-the-winner',
    'related_session' => 'predict-the-winner',
];
