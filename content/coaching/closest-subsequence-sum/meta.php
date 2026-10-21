<?php
declare(strict_types=1);

return [
    'title' => 'Closest Subsequence Sum: meet in the middle',
    'leetcode' => 1755,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: enumerate subset sums of each half, sort one, and binary search the closest complement for each sum of the other. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Meet in the Middle',
    'topic' => 'LeetCode · Meet in the Middle',
    'related_guide' => 'closest-subsequence-sum',
    'tags' => ['meet-in-the-middle', 'binary-search', 'bitmask', 'step-by-step'],
];
