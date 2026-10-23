<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Sum With at Most K Elements: cap each row, then take the top k',
    'leetcode' => 3462,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep each row’s best limits[i], then the k largest. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-sum-with-at-most-k-elements',
    'tags' => ['greedy', 'array', 'matrix', 'sorting', 'heap', 'step-by-step'],
];
