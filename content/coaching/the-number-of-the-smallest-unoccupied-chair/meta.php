<?php
declare(strict_types=1);

return [
    'title' => 'The Number of the Smallest Unoccupied Chair: release then seat',
    'leetcode' => 1942,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: process arrivals in order, release chairs whose leave time ≤ now into a min-heap, seat on the smallest free chair. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Heap',
    'topic' => 'LeetCode · Heap',
    'related_guide' => 'the-number-of-the-smallest-unoccupied-chair',
    'tags' => ['heap', 'simulation', 'sorting', 'step-by-step'],
];
