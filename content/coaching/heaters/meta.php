<?php
declare(strict_types=1);

return [
    'title' => 'Heaters: each house’s distance to its nearest heater, take the max',
    'leetcode' => 475,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: smallest common radius so heaters cover every house. Answer = max over houses of the distance to the nearest heater. Sort heaters; binary search each house and compare the heater just before and just after. [1,2,3], [2] → 1. [1,5], [2] → 3. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'sorting', 'two-pointers', 'step-by-step'],
    'related_guide' => 'heaters',
];
