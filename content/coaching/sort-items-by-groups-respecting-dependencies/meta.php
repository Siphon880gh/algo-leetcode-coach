<?php
declare(strict_types=1);

return [
    'title' => 'Sort Items by Groups: two Kahn passes',
    'leetcode' => 1203,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: give lone items their own groups, split dependencies into cross-group and in-group edges, sort groups then items in each group, and fail on any cycle. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'sort-items-by-groups-respecting-dependencies',
    'tags' => ['graphs', 'topological-sort', 'step-by-step'],
];
