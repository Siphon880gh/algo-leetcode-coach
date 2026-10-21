<?php
declare(strict_types=1);

return [
    'title' => 'Split Array Into Three: binary search the second cut',
    'leetcode' => 1712,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each first cut, the second cut must give middle ≥ left and right ≥ middle; binary search both bounds in the prefix array and count the range. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'ways-to-split-array-into-three-subarrays',
    'tags' => ['binary-search', 'prefix-sum', 'two-pointers', 'step-by-step'],
];
