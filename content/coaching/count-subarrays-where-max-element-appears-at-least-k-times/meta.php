<?php
declare(strict_types=1);

return [
    'title' => 'Count Subarrays Where Max Element Appears at Least K Times: k-th last position',
    'leetcode' => 2962,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track positions of the maximum and add pos[−k] + 1 per right end. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Sliding Window',
    'topic' => 'LeetCode · Sliding Window',
    'related_guide' => 'count-subarrays-where-max-element-appears-at-least-k-times',
    'tags' => ['array', 'sliding-window', 'step-by-step'],
];
