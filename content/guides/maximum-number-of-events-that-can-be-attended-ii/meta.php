<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Events That Can Be Attended II: DP with binary search',
    'leetcode' => 1751,
    'difficulty' => 'Hard',
    'summary' => 'Sort events by start. f(i, k) = max(skip event i, take it and jump to the first event starting after its end, with k − 1 left). Binary search finds that next event.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'maximum-number-of-events-that-can-be-attended-ii',
];
