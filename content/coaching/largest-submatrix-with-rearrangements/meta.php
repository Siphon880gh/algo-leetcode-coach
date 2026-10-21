<?php
declare(strict_types=1);

return [
    'title' => 'Largest Submatrix With Rearrangements: sorted column heights',
    'leetcode' => 1727,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: per row, keep each column\'s run of consecutive 1s ending there; sort those heights descending and take max of height[i] · (i + 1). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'largest-submatrix-with-rearrangements',
    'tags' => ['greedy', 'sorting', 'matrix', 'step-by-step'],
];
