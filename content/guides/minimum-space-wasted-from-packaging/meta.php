<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Space Wasted From Packaging: per supplier, bisect over sorted packages',
    'leetcode' => 1889,
    'difficulty' => 'Hard',
    'summary' => 'Sort packages with prefix sums. For each supplier whose largest box fits the largest package, walk its sorted boxes; each box size takes the packages between the previous cut and bisect_right(size). Waste = size · count − their sum.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'prefix-sum', 'sorting', 'leetcode'],
    'related_session' => 'minimum-space-wasted-from-packaging',
];
