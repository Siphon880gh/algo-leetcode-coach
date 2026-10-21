<?php
declare(strict_types=1);

return [
    'title' => 'Arranging Coins: largest k with k(k+1)/2 ≤ n',
    'leetcode' => 441,
    'difficulty' => 'Easy',
    'summary' => 'n coins, row i needs i coins. Return how many full rows. Largest k with k(k+1)/2 <= n: binary search k, or the closed form floor((sqrt(8n+1) − 1) / 2) with care for float error. n = 5 → 2. n = 8 → 3. Not 69 (plain sqrt).',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'math', 'leetcode'],
    'related_session' => 'arranging-coins',
];
