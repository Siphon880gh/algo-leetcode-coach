<?php
declare(strict_types=1);

return [
    'title' => 'Number of Beautiful Partitions: prime start, non-prime end',
    'leetcode' => 2478,
    'difficulty' => 'Hard',
    'summary' => 'Each part starts with a prime digit (2, 3, 5, 7), ends with a non-prime, and has length ≥ minLength. dp[p][i] = ways to split s[0..i) into p parts, cutting only where s[i−1] is non-prime and s[i] is prime.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'number-of-beautiful-partitions',
    'related_session' => 'number-of-beautiful-partitions',
];
