<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Form Subset Sum I',
    'leetcode' => 4040,
    'difficulty' => 'Med',
    'summary' => 'Each element becomes (x·2^a) >> b for a + b operations (all doublings first). List, per element, the cheapest cost for every reachable value ≤ sum. Then a 0/1 knapsack: dp[s] = fewest operations for a subset summing to s, where each element is skipped or contributes one of its values.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-form-subset-sum-i',
    'related_session' => 'minimum-operations-to-form-subset-sum-i',
];
