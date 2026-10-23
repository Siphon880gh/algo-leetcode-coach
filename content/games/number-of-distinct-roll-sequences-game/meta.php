<?php
declare(strict_types=1);

return [
    'title' => 'Number of Distinct Roll Sequences: remember the last two rolls',
    'leetcode' => 2318,
    'difficulty' => 'Hard',
    'summary' => 'dp[a][b] = sequences ending with rolls a, b. Next roll c needs gcd(b, c) = 1, c ≠ b and c ≠ a.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-distinct-roll-sequences',
    'related_session' => 'number-of-distinct-roll-sequences',
];
