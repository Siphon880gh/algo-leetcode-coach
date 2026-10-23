<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Incompatibility: bitmask over used numbers',
    'leetcode' => 1681,
    'difficulty' => 'Hard',
    'summary' => 'Split into k groups of size n/k, each with distinct values; a group\'s incompatibility is max − min. dp[mask] = best for the used numbers, always placing the lowest unused index in the next group.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-incompatibility',
    'related_session' => 'minimum-incompatibility',
];
