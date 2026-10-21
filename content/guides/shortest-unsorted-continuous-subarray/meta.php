<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Unsorted Continuous Subarray: two scans for the ends',
    'leetcode' => 581,
    'difficulty' => 'Med',
    'summary' => 'Scan left to right with a running max: the last index below it is the right end. Scan right to left with a running min: the last index above it is the left end.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'kind' => 'algo',
    'tags' => ['arrays', 'two-pointers', 'greedy', 'sorting', 'leetcode'],
    'related_session' => 'shortest-unsorted-continuous-subarray',
];
