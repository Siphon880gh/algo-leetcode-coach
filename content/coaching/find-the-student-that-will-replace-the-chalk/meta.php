<?php
declare(strict_types=1);

return [
    'title' => 'Find the Student that Will Replace the Chalk: skip full rounds',
    'leetcode' => 1894,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: k %= sum(chalk), then walk once until chalk[i] > k. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'related_guide' => 'find-the-student-that-will-replace-the-chalk',
    'tags' => ['prefix-sum', 'binary-search', 'simulation', 'step-by-step'],
];
