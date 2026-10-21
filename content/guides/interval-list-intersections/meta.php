<?php
declare(strict_types=1);

return [
    'title' => 'Interval List Intersections: two pointers on sorted lists',
    'leetcode' => 986,
    'difficulty' => 'Med',
    'summary' => 'Both lists are sorted and disjoint. Look at the current interval from each; their overlap is [max of starts, min of ends] when that is non-empty. Then advance the one that ends first.',
    'category' => 'LeetCode',
    'subcategory' => 'Two Pointers',
    'topic' => 'LeetCode · Two Pointers',
    'kind' => 'algo',
    'tags' => ['two-pointers', 'intervals', 'arrays', 'leetcode'],
    'related_session' => 'interval-list-intersections',
];
