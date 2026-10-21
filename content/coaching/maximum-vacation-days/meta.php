<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Vacation Days: DP over weeks and cities',
    'leetcode' => 568,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: f[w][j] is the best total after week w in city j; come from j (stay) or any city with a flight into j. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'related_guide' => 'maximum-vacation-days',
    'tags' => ['dynamic-programming', 'matrix', 'graph', 'step-by-step'],
];
