<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Reconstruct a Tree: degree-ordered parent check',
    'leetcode' => 1719,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: the root must pair with everyone; each other node\'s parent is its smallest-degree neighbour with degree ≥ its own, and its neighbours must be a subset of the parent\'s plus the parent. Equal degrees mean more than one way. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'related_guide' => 'number-of-ways-to-reconstruct-a-tree',
    'tags' => ['tree', 'graph', 'hash-set', 'step-by-step'],
];
