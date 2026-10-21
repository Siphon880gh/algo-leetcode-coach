<?php
declare(strict_types=1);

return [
    'title' => 'Longest Turbulent Subarray: rise and fall lengths',
    'leetcode' => 978,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep the run length ending with a rise and with a fall; a rise extends the fall run, a fall extends the rise run, and equal neighbors reset both. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'longest-turbulent-subarray',
    'tags' => ['dynamic-programming', 'sliding-window', 'arrays', 'step-by-step'],
];
