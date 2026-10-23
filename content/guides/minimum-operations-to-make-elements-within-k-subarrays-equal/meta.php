<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make Elements Within K Subarrays Equal: median cost, then a DP',
    'leetcode' => 3505,
    'difficulty' => 'Hard',
    'summary' => 'Making a window equal costs Σ |a − median|. Slide a size-x window with two heaps (or a sorted list) to get every window’s cost, then pick k non-overlapping windows with dp[j][i].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'math', 'dynamic-programming', 'sliding-window', 'heap', 'leetcode'],
    'related_session' => 'minimum-operations-to-make-elements-within-k-subarrays-equal',
];
