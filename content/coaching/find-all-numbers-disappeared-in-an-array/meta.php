<?php
declare(strict_types=1);

return [
    'title' => 'Find All Numbers Disappeared in an Array: mark slot x − 1 negative',
    'leetcode' => 448,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: values in [1, n]; return every value in 1..n that is missing, O(n) time, O(1) extra. Mark slot |x| − 1 negative for each x; slots still positive give the missing values. [4,3,2,7,8,2,3,1] → [5,6]. Not 442. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['arrays', 'hash-table', 'step-by-step'],
    'related_guide' => 'find-all-numbers-disappeared-in-an-array',
];
