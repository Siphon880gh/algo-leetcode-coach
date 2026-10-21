<?php
declare(strict_types=1);

return [
    'title' => 'Number of People Aware of a Secret: count new people per day',
    'leetcode' => 2327,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: track new people per day, share from j + delay up to the day before j + forget, and sum only the last forget days. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'number-of-people-aware-of-a-secret',
    'tags' => ['dynamic-programming', 'queue', 'simulation', 'step-by-step'],
];
