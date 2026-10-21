<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Number of Operations to Move All Balls to Each Box: two sweeps',
    'leetcode' => 1769,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sweep left to right adding the running cost, then the ball count to the cost; repeat right to left; sum both. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'minimum-number-of-operations-to-move-all-balls-to-each-box',
    'tags' => ['prefix-sum', 'array', 'step-by-step'],
];
