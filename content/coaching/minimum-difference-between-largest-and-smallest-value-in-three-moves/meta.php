<?php
declare(strict_types=1);

return [
    'title' => 'Min Difference in Three Moves: four trims',
    'leetcode' => 1509,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: if n ≤ 4 return 0; sort; take min over i in 0..3 of a[n−4+i] − a[i]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-difference-between-largest-and-smallest-value-in-three-moves',
    'tags' => ['greedy', 'sorting', 'step-by-step'],
];
