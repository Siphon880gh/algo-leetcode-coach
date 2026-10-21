<?php
declare(strict_types=1);

return [
    'title' => 'Min Cost to Connect Two Groups: bitmask over group 2',
    'leetcode' => 1595,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: give each group-1 point one partner while tracking which group-2 points are covered; finally add each uncovered group-2 point\'s cheapest edge. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'minimum-cost-to-connect-two-groups-of-points',
    'tags' => ['dynamic-programming', 'bitmask', 'step-by-step'],
];
