<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Length of Semi-Decreasing Subarrays: fold equal values late, track the smallest index',
    'leetcode' => 2863,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: scan by value from largest, fold each equal group in after scanning it, and track the smallest index seen. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sorting',
    'topic' => 'LeetCode · Sorting',
    'related_guide' => 'maximum-length-of-semi-decreasing-subarrays',
    'tags' => ['array', 'stack', 'sorting', 'monotonic-stack', 'step-by-step'],
];
