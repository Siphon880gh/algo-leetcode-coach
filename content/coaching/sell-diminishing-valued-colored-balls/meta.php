<?php
declare(strict_types=1);

return [
    'title' => 'Sell Diminishing-Valued Balls: threshold binary search',
    'leetcode' => 1648,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: binary search the smallest threshold T with Σ max(0, x − T) ≤ orders; sell everything above T by arithmetic series; sell leftovers at T. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'related_guide' => 'sell-diminishing-valued-colored-balls',
    'tags' => ['binary-search', 'greedy', 'math', 'step-by-step'],
];
