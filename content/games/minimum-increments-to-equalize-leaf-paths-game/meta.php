<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Increments to Equalize Leaf Paths',
    'leetcode' => 3593,
    'difficulty' => 'Med',
    'summary' => 'Compute best[u] = cost[u] + max best[child] bottom-up. At every node, each child whose best is below the largest child best must be raised once (raise that child itself), so count those children.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-increments-to-equalize-leaf-paths',
    'related_session' => 'minimum-increments-to-equalize-leaf-paths',
];
