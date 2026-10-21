<?php
declare(strict_types=1);

return [
    'title' => 'Number of Ways to Reconstruct a Tree: ancestor degrees',
    'leetcode' => 1719,
    'difficulty' => 'Hard',
    'summary' => 'A pair means ancestor–descendant, so the root must touch every node. For each other node, its parent is the neighbour with the smallest degree ≥ its own; that parent\'s neighbour set must contain all of its other neighbours. Equal degrees mean the two can swap (answer 2).',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'graph', 'hash-set', 'leetcode'],
    'related_session' => 'number-of-ways-to-reconstruct-a-tree',
];
