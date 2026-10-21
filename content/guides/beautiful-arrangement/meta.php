<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Arrangement: backtrack positions with a used mask',
    'leetcode' => 526,
    'difficulty' => 'Med',
    'summary' => 'Count permutations of 1..n where, at each 1-indexed position i, perm[i] % i == 0 or i % perm[i] == 0. Fill positions in order, trying unused numbers that fit, and count full fills. Or bitmask DP where the next position is popcount(mask) + 1. n = 2 → 2. n = 3 → 3. n ≤ 15.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'bitmask', 'dynamic-programming', 'leetcode'],
    'related_session' => 'beautiful-arrangement',
];
