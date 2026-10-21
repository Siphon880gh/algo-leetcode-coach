<?php
declare(strict_types=1);

return [
    'title' => 'Arranging Coins: largest k with k(k+1)/2 ≤ n',
    'leetcode' => 441,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: n coins, row i needs i coins; return the number of full rows. Largest k with k(k + 1) / 2 <= n by binary search with 64-bit math, or the closed form checked with integers. n = 5 → 2. n = 8 → 3. Not 69. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'math', 'step-by-step'],
    'related_guide' => 'arranging-coins',
];
