<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Grid Happiness: broken-profile DP',
    'leetcode' => 1659,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: go cell by cell keeping the last n cells as a base-3 profile; placing someone scores their base plus adjustments with the up and left neighbours. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximize-grid-happiness',
    'tags' => ['dynamic-programming', 'bitmask', 'memoization', 'step-by-step'],
];
