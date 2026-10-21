<?php
declare(strict_types=1);

return [
    'title' => 'Optimal Account Balancing: zero-sum groups of net balances',
    'leetcode' => 465,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: fewest transfers to settle debts. Reduce to net balances and drop zeros. A zero-sum group of k people settles in k − 1 transfers, so maximize zero-sum groups with a bitmask DP (or backtracking). [[0,1,10],[2,0,5]] → 2. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dynamic-programming', 'bitmask', 'backtracking', 'step-by-step'],
    'related_guide' => 'optimal-account-balancing',
];
