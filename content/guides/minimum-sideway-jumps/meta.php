<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Sideway Jumps: three-lane DP',
    'leetcode' => 1824,
    'difficulty' => 'Med',
    'summary' => 'Keep the minimum jumps to stand in each lane at the current point. At each point, block the obstacle lane, then let every free lane take min over lanes + 1 (a side jump).',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['dynamic-programming', 'greedy', 'array', 'leetcode'],
    'related_session' => 'minimum-sideway-jumps',
];
