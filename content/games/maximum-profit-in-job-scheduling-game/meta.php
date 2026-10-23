<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Profit in Job Scheduling: take it or skip it, sorted by end',
    'leetcode' => 1235,
    'difficulty' => 'Hard',
    'summary' => 'Sort jobs by end time. best[i] = max(best[i−1], profit[i] + best of the last job ending at or before start[i]) (binary search).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'tags' => ['dp', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-profit-in-job-scheduling',
    'related_session' => 'maximum-profit-in-job-scheduling',
];
