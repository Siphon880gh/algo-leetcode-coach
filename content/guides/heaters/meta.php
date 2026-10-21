<?php
declare(strict_types=1);

return [
    'title' => 'Heaters: each house’s distance to its nearest heater, take the max',
    'leetcode' => 475,
    'difficulty' => 'Med',
    'summary' => 'Houses and heaters on a line; all heaters share one radius. Smallest radius that covers every house = max over houses of the distance to the nearest heater. Sort heaters; binary search each house for the neighbors on both sides. [1,2,3], [2] → 1. [1,2,3,4], [1,4] → 1. [1,5], [2] → 3.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-search', 'sorting', 'two-pointers', 'leetcode'],
    'related_session' => 'heaters',
];
