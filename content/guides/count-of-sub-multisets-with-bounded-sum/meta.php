<?php
declare(strict_types=1);

return [
    'title' => 'Count of Sub-Multisets With Bounded Sum: bounded knapsack with a sliding sum',
    'leetcode' => 2902,
    'difficulty' => 'Hard',
    'summary' => 'Group equal values. For value v with c copies, new[s] = Σ old[s − t·v] for t = 0 … c, kept as a running sum. Zeros only multiply the count by (zeros + 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'sliding-window', 'leetcode'],
    'related_session' => 'count-of-sub-multisets-with-bounded-sum',
];
