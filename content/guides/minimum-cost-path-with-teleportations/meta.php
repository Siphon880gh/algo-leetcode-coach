<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with Teleportations: DP layer per teleport',
    'leetcode' => 3651,
    'difficulty' => 'Hard',
    'summary' => 'Layer t is the cheapest cost per cell with at most t teleports. Teleporting into a cell with value v costs the best cost of layer t − 1 over cells with value ≥ v; then run the right/down DP.',
    'category' => 'LeetCode',
    'subcategory' => 'Dynamic Programming',
    'topic' => 'LeetCode · Dynamic Programming',
    'kind' => 'algo',
    'tags' => ['array', 'dynamic-programming', 'matrix', 'leetcode'],
    'related_session' => 'minimum-cost-path-with-teleportations',
];
