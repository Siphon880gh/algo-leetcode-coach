<?php
declare(strict_types=1);

return [
    'title' => 'Find Good Days to Rob the Bank: run lengths from both sides',
    'leetcode' => 2100,
    'difficulty' => 'Med',
    'summary' => 'left[i] = how many days before i the guards keep not increasing up to i; right[i] = how many days after i they keep not decreasing. Day i is good when both are at least time.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['prefix-sum', 'dynamic-programming', 'array', 'leetcode'],
    'related_session' => 'find-good-days-to-rob-the-bank',
];
