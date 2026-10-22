<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum With K Elements: always the maximum, series k(k − 1)/2',
    'leetcode' => 2656,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: pick the maximum each time, and add k(k − 1)/2 for the growing picks. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-sum-with-exactly-k-elements',
    'tags' => ['greedy', 'array', 'step-by-step'],
];
