<?php
declare(strict_types=1);

return [
    'title' => 'Complementary Array Moves: difference array over sums',
    'leetcode' => 1674,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: each pair (x ≤ y) costs 2, 1 or 0 per target sum by range; add these to a difference array over [2, 2·limit]; take the min prefix sum. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'minimum-moves-to-make-array-complementary',
    'tags' => ['prefix-sum', 'difference-array', 'step-by-step'],
];
