<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Difficulty of a Job Schedule: partition DP',
    'leetcode' => 1335,
    'difficulty' => 'Hard',
    'summary' => 'Jobs stay in order and each of the d days takes at least one. f(i, k) is the cheapest way to schedule jobs i.. in k days: the first day takes jobs i..j, costing their maximum, plus f(j + 1, k − 1).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'leetcode'],
    'related_session' => 'minimum-difficulty-of-a-job-schedule',
];
