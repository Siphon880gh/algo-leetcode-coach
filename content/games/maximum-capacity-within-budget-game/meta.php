<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Capacity Within Budget',
    'leetcode' => 3814,
    'difficulty' => 'Med',
    'summary' => 'Sort machines by cost and build a prefix maximum of capacity. For each machine i, binary search the cheaper machines (before i) whose cost keeps the total strictly below budget and add the best prefix capacity there. A single machine alone is also allowed.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'tags' => ['binary-search', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-capacity-within-budget',
    'related_session' => 'maximum-capacity-within-budget',
];
