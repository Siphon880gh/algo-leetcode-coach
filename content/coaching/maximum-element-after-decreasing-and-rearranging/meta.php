<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Element After Decreasing and Rearranging: staircase cap',
    'leetcode' => 1846,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: sort, then set cur = min(cur + 1, x) for each value. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'related_guide' => 'maximum-element-after-decreasing-and-rearranging',
    'tags' => ['greedy', 'sorting', 'array', 'step-by-step'],
];
