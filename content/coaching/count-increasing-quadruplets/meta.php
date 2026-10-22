<?php
declare(strict_types=1);

return [
    'title' => 'Count Increasing Quadruplets: add the smaller count, close with the full count',
    'leetcode' => 2552,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: grow cnt[j] by the number of smaller earlier values, and add all of cnt[j] when a larger l closes it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'count-increasing-quadruplets',
    'tags' => ['array', 'dynamic-programming', 'prefix-sum', 'enumeration', 'step-by-step'],
];
