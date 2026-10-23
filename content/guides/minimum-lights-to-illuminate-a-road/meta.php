<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Lights to Illuminate a Road: difference array, then greedy',
    'leetcode' => 3964,
    'difficulty' => 'Med',
    'summary' => 'Mark lit positions with a difference array. Then walk left to right: at the first dark position p, put a bulb at p + 1 to cover p … p + 2 and jump to p + 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Greedy',
    'topic' => 'LeetCode · Greedy',
    'kind' => 'algo',
    'tags' => ['array', 'prefix-sum', 'leetcode'],
    'related_session' => 'minimum-lights-to-illuminate-a-road',
];
