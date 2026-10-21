<?php
declare(strict_types=1);

return [
    'title' => 'Global and Local Inversions: only distance ≥ 2 matters',
    'leetcode' => 775,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: local inversions are global, so look only for an inversion between elements two or more apart, or use |nums[i] − i| ≤ 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Math',
    'topic' => 'LeetCode · Math',
    'related_guide' => 'global-and-local-inversions',
    'tags' => ['math', 'arrays', 'step-by-step'],
];
