<?php
declare(strict_types=1);

return [
    'title' => 'Partition Array Into Three Parts With Equal Sum: count prefix hits',
    'leetcode' => 1013,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: check total % 3, scan with a running sum, count each time it reaches total / 3 and reset, and accept three or more parts. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'partition-array-into-three-parts-with-equal-sum',
    'tags' => ['greedy', 'arrays', 'prefix-sum', 'step-by-step'],
];
