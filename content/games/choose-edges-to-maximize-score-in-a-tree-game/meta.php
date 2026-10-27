<?php
declare(strict_types=1);

return [
    'title' => 'Choose Non-Adjacent Edges: matching DP on a tree',
    'leetcode' => 2378,
    'difficulty' => 'Med',
    'summary' => 'For each node: free(u) = the sum of best(children) (no edge to a child used); best(u) = max(free(u), free(u) − best(c) + free(c) + w(c)) over children c.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'choose-edges-to-maximize-score-in-a-tree',
    'related_session' => 'choose-edges-to-maximize-score-in-a-tree',
];
