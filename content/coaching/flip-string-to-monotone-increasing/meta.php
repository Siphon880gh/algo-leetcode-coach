<?php
declare(strict_types=1);

return [
    'title' => 'Flip String to Monotone Increasing: flips versus ones',
    'leetcode' => 926,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: count 1s so far; at each 0, either flip it (flips + 1) or flip all earlier 1s (ones), and keep the smaller. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'flip-string-to-monotone-increasing',
    'tags' => ['dynamic-programming', 'strings', 'prefix-sum', 'step-by-step'],
];
