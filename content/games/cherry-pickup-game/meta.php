<?php
declare(strict_types=1);

return [
    'title' => 'Cherry Pickup: two walkers move together',
    'leetcode' => 741,
    'difficulty' => 'Hard',
    'summary' => 'Walk two paths from the top-left at the same time; after t steps each is on anti-diagonal t. dp[r1][r2] = most cherries; a shared cell counts once. Thorns (−1) kill a state.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'cherry-pickup',
    'related_session' => 'cherry-pickup',
];
