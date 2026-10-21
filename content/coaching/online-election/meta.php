<?php
declare(strict_types=1);

return [
    'title' => 'Online Election: leaders by time',
    'leetcode' => 911,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: replay the votes once to record the leader after each vote, letting ties go to the latest vote, then binary search the time for each query. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'online-election',
    'tags' => ['binary-search', 'design', 'hash-table', 'step-by-step'],
];
