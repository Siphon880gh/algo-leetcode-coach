<?php
declare(strict_types=1);

return [
    'title' => 'Sum of Consecutive Subsequences: per-value counts for each direction',
    'leetcode' => 3299,
    'difficulty' => 'Hard',
    'summary' => 'For each value v keep, per direction, how many consecutive subsequences end with v and the total of their sums. A new x extends every one ending at x − 1 (or x + 1), adding x to each. Singletons are counted in both directions, so subtract them once.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'dynamic-programming', 'leetcode'],
    'related_session' => 'sum-of-consecutive-subsequences',
];
