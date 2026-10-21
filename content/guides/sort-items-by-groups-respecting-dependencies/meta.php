<?php
declare(strict_types=1);

return [
    'title' => 'Sort Items by Groups Respecting Dependencies: two topological sorts',
    'leetcode' => 1203,
    'difficulty' => 'Hard',
    'summary' => 'Give every ungrouped item its own new group. Topologically sort the groups using cross-group edges and the items inside each group using in-group edges, then concatenate; any cycle means no answer.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['graphs', 'topological-sort', 'leetcode'],
    'related_session' => 'sort-items-by-groups-respecting-dependencies',
];
