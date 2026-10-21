<?php
declare(strict_types=1);

return [
    'title' => 'Min Increments to Form Target: count rises',
    'leetcode' => 1526,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: answer = target[0] + Σ max(0, target[i] − target[i − 1]). Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-number-of-increments-on-subarrays-to-form-a-target-array',
    'tags' => ['greedy', 'arrays', 'step-by-step'],
];
