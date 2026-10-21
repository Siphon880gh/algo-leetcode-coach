<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Groups Getting Fresh Donuts: memo on remainder counts',
    'leetcode' => 1815,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: reduce sizes mod b; remainder-0 groups are always happy; memoise on the counts of the other remainders, gaining 1 whenever the leftover is 0 before a group. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-number-of-groups-getting-fresh-donuts',
    'tags' => ['dynamic-programming', 'memoization', 'bitmask', 'step-by-step'],
];
