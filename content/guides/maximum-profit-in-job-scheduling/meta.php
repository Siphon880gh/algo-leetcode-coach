<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit in Job Scheduling: sort by end, binary search',
    'leetcode' => 1235,
    'difficulty' => 'Hard',
    'summary' => 'Sort jobs by end time. best[i] is the top profit using the first i jobs; job i either is skipped or adds its profit to the best value among jobs that end by its start, found by binary search.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'maximum-profit-in-job-scheduling',
];
