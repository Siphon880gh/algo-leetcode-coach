<?php
declare(strict_types=1);

return [
    'title' => 'Optimal Account Balancing: zero-sum groups of net balances',
    'leetcode' => 465,
    'difficulty' => 'Hard',
    'summary' => 'Fewest transfers to settle all debts. Compute each person’s net balance and drop zeros. A group of k people whose balances sum to 0 settles in k − 1 transfers, so maximize the number of zero-sum groups. Bitmask DP over subsets (or backtracking) on at most about a dozen nonzero balances. [[0,1,10],[2,0,5]] → 2. [[0,1,10],[1,0,1],[1,2,5],[2,0,5]] → 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'bitmask', 'backtracking', 'leetcode'],
    'related_session' => 'optimal-account-balancing',
];
