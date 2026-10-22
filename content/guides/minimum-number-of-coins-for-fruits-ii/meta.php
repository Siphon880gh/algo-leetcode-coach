<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Coins for Fruits II: monotonic deque',
    'leetcode' => 2969,
    'difficulty' => 'Hard',
    'summary' => 'This assumes the rules match part I. f(i) = prices[i] + min f(j) over j in i + 1 … 2i + 1; the window slides as i decreases, so a monotonic deque gives each minimum in O(1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'queue', 'monotonic-queue', 'heap', 'leetcode'],
    'related_session' => 'minimum-number-of-coins-for-fruits-ii',
];
