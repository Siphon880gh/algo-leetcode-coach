<?php
declare(strict_types=1);

return [
    'title' => 'Beautiful Arrangement: backtrack positions with a used mask',
    'leetcode' => 526,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count permutations of 1..n with perm[i] % i == 0 or i % perm[i] == 0 (1-indexed). Fill positions in order, trying unused fitting numbers; or bitmask DP over used sets. n = 2 → 2. n = 3 → 3. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'bitmask', 'dynamic-programming', 'step-by-step'],
    'related_guide' => 'beautiful-arrangement',
];
