<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Vacation Days: DP over weeks and cities',
    'leetcode' => 568,
    'difficulty' => 'Hard',
    'summary' => 'f[w][j] is the best total after w weeks ending in city j. Each week, come from j itself or from any city with a flight into j, then add days[j][w].',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'matrix', 'graph', 'leetcode'],
    'related_session' => 'maximum-vacation-days',
];
