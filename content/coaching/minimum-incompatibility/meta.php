<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Incompatibility: bitmask over groups',
    'leetcode' => 1681,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: precompute cost for each size-n/k subset with distinct values; dp over masks, always placing the lowest free index into the next group. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-incompatibility',
    'tags' => ['dynamic-programming', 'bitmask', 'step-by-step'],
];
