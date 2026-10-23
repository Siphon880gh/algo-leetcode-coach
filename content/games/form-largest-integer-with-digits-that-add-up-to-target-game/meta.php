<?php
declare(strict_types=1);

return [
    'title' => 'Form Largest Integer: most digits first, then biggest digits',
    'leetcode' => 1449,
    'difficulty' => 'Hard',
    'summary' => 'dp[t] = most digits with total cost exactly t (−∞ if impossible). Then build greedily: at each step take the largest digit d with dp[t − cost[d]] == dp[t] − 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'form-largest-integer-with-digits-that-add-up-to-target',
    'related_session' => 'form-largest-integer-with-digits-that-add-up-to-target',
];
