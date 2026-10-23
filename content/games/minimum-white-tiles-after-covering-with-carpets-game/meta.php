<?php
declare(strict_types=1);

return [
    'title' => 'Minimum White Tiles After Carpets: cover here or not',
    'leetcode' => 2209,
    'difficulty' => 'Hard',
    'summary' => 'dp[c][i] = fewest white tiles visible among the first i tiles using c carpets = min(dp[c][i−1] + white(i−1), dp[c−1][i − carpetLen]).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-white-tiles-after-covering-with-carpets',
    'related_session' => 'minimum-white-tiles-after-covering-with-carpets',
];
