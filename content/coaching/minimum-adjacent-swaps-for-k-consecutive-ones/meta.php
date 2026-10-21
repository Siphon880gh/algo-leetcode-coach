<?php
declare(strict_types=1);

return [
    'title' => 'K Consecutive Ones: shift positions, use the median',
    'leetcode' => 1703,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: positions of ones minus their index turn the target block into a single point; for each window of k, cost is distance to the median via prefix sums. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'minimum-adjacent-swaps-for-k-consecutive-ones',
    'tags' => ['sliding-window', 'prefix-sum', 'greedy', 'step-by-step'],
];
