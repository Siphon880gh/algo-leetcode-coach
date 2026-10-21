<?php
declare(strict_types=1);

return [
    'title' => 'Capacity To Ship Packages Within D Days: binary search the capacity',
    'leetcode' => 1011,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: search capacities from max(weights) to sum(weights), and test each by loading packages in order until a day overflows. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'capacity-to-ship-packages-within-d-days',
    'tags' => ['binary-search', 'greedy', 'arrays', 'step-by-step'],
];
