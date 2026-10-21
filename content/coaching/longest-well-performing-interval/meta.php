<?php
declare(strict_types=1);

return [
    'title' => 'Longest Well-Performing Interval: prefix ±1',
    'leetcode' => 1124,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: score days +1 or −1, keep the first index of each prefix sum, and for each day take the whole prefix if positive, otherwise look up the first index of prefix − 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Hash Table',
    'topic' => 'LeetCode · Hash Table',
    'related_guide' => 'longest-well-performing-interval',
    'tags' => ['hash-table', 'prefix-sum', 'monotonic-stack', 'step-by-step'],
];
