<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Number of Points with Cost: left and right sweeps',
    'leetcode' => 1937,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: for each row, compute left-best and right-best arrays with a −1 per step, then add the row. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-number-of-points-with-cost',
    'tags' => ['dynamic-programming', 'prefix-sum', 'step-by-step'],
];
