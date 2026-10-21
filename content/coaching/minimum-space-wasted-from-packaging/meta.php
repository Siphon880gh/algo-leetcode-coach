<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Space Wasted From Packaging: bisect per box size',
    'leetcode' => 1889,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: sort packages with prefix sums; per supplier, walk sorted boxes, bisect, and add size · count − sum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'minimum-space-wasted-from-packaging',
    'tags' => ['binary-search', 'prefix-sum', 'sorting', 'step-by-step'],
];
