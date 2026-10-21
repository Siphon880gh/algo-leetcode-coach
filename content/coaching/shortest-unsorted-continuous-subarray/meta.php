<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Unsorted Continuous Subarray: two scans for the ends',
    'leetcode' => 581,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: the right end is the last value below the max to its left; the left end is the last value, from the right, above the min to its right. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'related_guide' => 'shortest-unsorted-continuous-subarray',
    'tags' => ['arrays', 'two-pointers', 'greedy', 'sorting', 'step-by-step'],
];
