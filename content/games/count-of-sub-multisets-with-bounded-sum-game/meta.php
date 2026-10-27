<?php
declare(strict_types=1);

return [
    'title' => 'Count of Sub-Multisets With Bounded Sum: bounded knapsack by value',
    'leetcode' => 2902,
    'difficulty' => 'Hard',
    'summary' => 'Group equal values. For value v with count c: new[s] = the sum of dp[s − t times v] for t = 0 to c (a sliding-window sum in the fast version). Zeros multiply everything by (zeros + 1). Sum dp over l to r.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'count-of-sub-multisets-with-bounded-sum',
    'related_session' => 'count-of-sub-multisets-with-bounded-sum',
];
