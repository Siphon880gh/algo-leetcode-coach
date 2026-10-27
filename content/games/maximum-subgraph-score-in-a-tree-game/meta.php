<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Subgraph Score in a Tree',
    'leetcode' => 3772,
    'difficulty' => 'Hard',
    'summary' => 'Rerooting DP. down[u] = (good ? 1 : −1) + the sum of max(0, down[child]). Then going down, a child v gets ans[v] = down[v] + max(0, ans[u] − max(0, down[v])).',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-subgraph-score-in-a-tree',
    'related_session' => 'maximum-subgraph-score-in-a-tree',
];
