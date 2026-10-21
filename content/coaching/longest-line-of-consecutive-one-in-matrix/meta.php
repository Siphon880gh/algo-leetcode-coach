<?php
declare(strict_types=1);

return [
    'title' => 'Longest Line of Consecutive One in Matrix: four counts per cell',
    'leetcode' => 562,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a run length per direction at every cell, built from finished neighbors, and reset at 0. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-line-of-consecutive-one-in-matrix',
    'tags' => ['dynamic-programming', 'matrix', 'step-by-step'],
];
