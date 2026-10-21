<?php
declare(strict_types=1);

return [
    'title' => 'Divide Array Into Increasing Sequences: max frequency times k',
    'leetcode' => 1121,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: equal values must go to different subsequences, so the most frequent value fixes the number of subsequences; the split works exactly when maxFreq · k ≤ n. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'divide-array-into-increasing-sequences',
    'tags' => ['math', 'greedy', 'arrays', 'step-by-step'],
];
