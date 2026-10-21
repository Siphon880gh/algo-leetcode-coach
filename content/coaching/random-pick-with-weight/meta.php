<?php
declare(strict_types=1);

return [
    'title' => 'Random Pick with Weight: prefix sums and binary search',
    'leetcode' => 528,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: pickIndex() returns i with probability w[i] / sum. Prefix sums; draw x in [1, total]; bisect_left finds the first prefix ≥ x. [1,3] → index 1 three quarters of the time. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'prefix-sum', 'probability', 'randomized', 'step-by-step'],
    'related_guide' => 'random-pick-with-weight',
];
