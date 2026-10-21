<?php
declare(strict_types=1);

return [
    'title' => 'Count Subtrees With Max Distance Between Cities: subsets plus Floyd',
    'leetcode' => 1617,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 15: precompute all-pairs distances; for each subset of cities, it is a subtree when it has exactly size − 1 internal edges; its diameter is the max pairwise distance.',
    'category' => 'LeetCode',
    'subcategory' => 'Bit Manipulation',
    'topic' => 'LeetCode · Bit Manipulation',
    'kind' => 'algo',
    'tags' => ['bitmask', 'tree', 'enumeration', 'leetcode'],
    'related_session' => 'count-subtrees-with-max-distance-between-cities',
];
