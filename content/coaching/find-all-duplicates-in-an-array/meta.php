<?php
declare(strict_types=1);

return [
    'title' => 'Find All Duplicates in an Array: values 1..n mark their own slot',
    'leetcode' => 442,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: values in [1, n] each appear once or twice; return those that appear twice in O(n) time, O(1) extra. For x = |nums[i]|, look at nums[x − 1]: negative means seen, so x repeats; else flip it negative. [4,3,2,7,8,2,3,1] → [2,3]. Not 287 / 448. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['arrays', 'hash-table', 'step-by-step'],
    'related_guide' => 'find-all-duplicates-in-an-array',
];
