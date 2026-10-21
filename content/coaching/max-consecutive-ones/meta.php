<?php
declare(strict_types=1);

return [
    'title' => 'Max Consecutive Ones: running count, reset at zero',
    'leetcode' => 485,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: longest run of 1s in a binary array. Count up on 1, reset on 0, track the max on every 1. [1,1,0,1,1,1] → 3. [1,0,1,1,0,1] → 2. Not 487 / 1004. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Arrays',
    'topic' => 'LeetCode · Arrays',
    'tags' => ['arrays', 'step-by-step'],
    'related_guide' => 'max-consecutive-ones',
];
