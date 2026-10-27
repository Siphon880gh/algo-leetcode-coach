<?php
declare(strict_types=1);

return [
    'title' => 'Maximize Spanning Tree Stability with Upgrades',
    'leetcode' => 3600,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the stability X. Join every must edge (a cycle or a must edge below X kills it), then free optional edges with s ≥ X, then optional edges with 2s ≥ X while upgrades last. X works if everything ends up connected.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'tags' => ['union-find', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximize-spanning-tree-stability-with-upgrades',
    'related_session' => 'maximize-spanning-tree-stability-with-upgrades',
];
