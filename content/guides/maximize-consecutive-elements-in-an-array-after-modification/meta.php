<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Consecutive Elements in an Array After Modification: DP over values',
    'leetcode' => 3041,
    'difficulty' => 'Hard',
    'summary' => 'Sort. Let d[v] be the longest consecutive run ending at value v. Each x can become x + 1 or stay x: set d[x + 1] = d[x] + 1 first, then d[x] = d[x − 1] + 1.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'sorting', 'leetcode'],
    'related_session' => 'maximize-consecutive-elements-in-an-array-after-modification',
];
