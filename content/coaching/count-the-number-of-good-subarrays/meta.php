<?php
declare(strict_types=1);

return [
    'title' => 'Count the Number of Good Subarrays: count pairs, add the start count',
    'leetcode' => 2537,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: add cnt[x] pairs when x enters, and add l, the number of good starts, for each end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'count-the-number-of-good-subarrays',
    'tags' => ['array', 'hash-table', 'sliding-window', 'step-by-step'],
];
