<?php
declare(strict_types=1);

return [
    'title' => 'Count Number of Nice Subarrays: prefix odd counts',
    'leetcode' => 1248,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count odd numbers in a running prefix, add how many earlier prefixes equal current − k, and record the current prefix. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'count-number-of-nice-subarrays',
    'tags' => ['prefix-sum', 'hash-table', 'sliding-window', 'step-by-step'],
];
