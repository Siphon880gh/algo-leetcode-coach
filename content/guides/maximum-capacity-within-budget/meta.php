<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Capacity Within Budget: sort by cost and binary search',
    'leetcode' => 3814,
    'difficulty' => 'Med',
    'summary' => 'Sort machines by cost and keep a running maximum of capacity. For each machine, binary search the cheaper ones whose cost keeps the total strictly under budget and add the best capacity among them. Also try each machine alone.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['array', 'two-pointers', 'binary-search', 'sorting', 'leetcode'],
    'related_session' => 'maximum-capacity-within-budget',
];
