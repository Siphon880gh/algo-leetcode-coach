<?php
declare(strict_types=1);

return [
    'title' => 'Split Array into Consecutive Subsequences: extend first, then start',
    'leetcode' => 659,
    'difficulty' => 'Med',
    'summary' => 'Scan the values in order with two maps: how many of each value remain, and how many runs end at each value. Extend a run that ends at x − 1 if you can; otherwise start x, x + 1, x + 2; otherwise fail.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['greedy', 'hash-table', 'heap', 'leetcode'],
    'related_session' => 'split-array-into-consecutive-subsequences',
];
