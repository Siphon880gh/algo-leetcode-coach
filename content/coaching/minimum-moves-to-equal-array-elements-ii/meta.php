<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Equal Array Elements II: meet at the median',
    'leetcode' => 462,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: one move adds or subtracts 1 from one element. Total moves to a target t is Σ |x − t|, smallest when t is a median. Sort (or quickselect) and sum distances to nums[n / 2]. [1,2,3] → 2. [1,10,2,9] → 16. Not 453. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'tags' => ['math', 'sorting', 'median', 'step-by-step'],
    'related_guide' => 'minimum-moves-to-equal-array-elements-ii',
];
