<?php
declare(strict_types=1);

return [
    'title' => 'Score After Flipping Matrix: leading 1s, then column majorities',
    'leetcode' => 861,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: flip rows so each starts with 1, then flip any column with more 0s than 1s, and add the column counts by bit weight. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'score-after-flipping-matrix',
    'tags' => ['greedy', 'bit-manipulation', 'matrix', 'step-by-step'],
];
