<?php
declare(strict_types=1);

return [
    'title' => 'Count Unhappy Friends: rank table',
    'leetcode' => 1583,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: build rank[x][y] (position of y in x\'s list) and partner[x]; x is unhappy if some u ranked above partner[x] prefers x over partner[u]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'count-unhappy-friends',
    'tags' => ['simulation', 'arrays', 'step-by-step'],
];
