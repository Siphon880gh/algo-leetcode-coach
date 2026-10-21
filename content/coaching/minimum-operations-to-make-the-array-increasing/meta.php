<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make the Array Increasing: raise to prev + 1',
    'leetcode' => 1827,
    'difficulty' => 'Easy',
    'summary' => 'Walk a deterministic path: prev = nums[0]; each next value becomes max(prev + 1, x), costing the difference. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'minimum-operations-to-make-the-array-increasing',
    'tags' => ['greedy', 'array', 'step-by-step'],
];
