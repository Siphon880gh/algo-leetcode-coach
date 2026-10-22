<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number That Sum of the Prices Is Less Than or Equal to K: binary search on a bit count',
    'leetcode' => 3007,
    'difficulty' => 'Med',
    'summary' => 'The accumulated price grows with num, so binary-search num. For a bit j, the count of numbers in [0, N] with it set is ⌊(N + 1) / 2^(j+1)⌋ · 2^j + max(0, (N + 1) mod 2^(j+1) − 2^j); add it for bits x, 2x, 3x, ….',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'math', 'binary-search', 'dynamic-programming', 'leetcode'],
    'related_session' => 'maximum-number-that-sum-of-the-prices-is-less-than-or-equal-to-k',
];
