<?php
declare(strict_types=1);

return [
    'title' => 'First Day Where You Have Been in All the Rooms: replay DP',
    'leetcode' => 1997,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: f[i] = 2·f[i − 1] − f[nextVisit[i − 1]] + 2 mod 1e9+7. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'first-day-where-you-have-been-in-all-the-rooms',
    'tags' => ['dynamic-programming', 'array', 'step-by-step'],
];
