<?php
declare(strict_types=1);

return [
    'title' => 'Collect Coins in a Tree: trim empty leaves, then two layers',
    'leetcode' => 2603,
    'difficulty' => 'Hard',
    'summary' => 'Leaves without coins never need visiting, so strip them repeatedly. Every remaining leaf has a coin, which can be collected from 2 edges away, so remove two more layers of leaves. Each edge left is walked twice.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['array', 'tree', 'graph', 'topological-sort', 'leetcode'],
    'related_session' => 'collect-coins-in-a-tree',
];
