<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit in Job Scheduling: DP over end times',
    'leetcode' => 1235,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort by end, and for each job take the better of skipping it or adding its profit to the best total among jobs ending by its start, found with binary search. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-profit-in-job-scheduling',
    'tags' => ['dynamic-programming', 'binary-search', 'sorting', 'step-by-step'],
];
