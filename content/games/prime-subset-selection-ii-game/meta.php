<?php
declare(strict_types=1);

return [
    'title' => 'Prime Subset Selection II',
    'leetcode' => 4081,
    'difficulty' => 'Hard',
    'summary' => '0/1 knapsack over the primes: suf[i][t] = the fewest primes from index i onward summing to exactly t. Take the largest reachable T ≤ s, then rebuild left to right, always taking the smallest prime that still finishes T with one fewer prime.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'prime-subset-selection-ii',
    'related_session' => 'prime-subset-selection-ii',
];
