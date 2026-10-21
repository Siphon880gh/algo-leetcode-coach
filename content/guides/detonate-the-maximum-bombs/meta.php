<?php
declare(strict_types=1);

return [
    'title' => 'Detonate the Maximum Bombs: directed reachability',
    'leetcode' => 2101,
    'difficulty' => 'Med',
    'summary' => 'Bomb i triggers j when j lies within i\'s radius (compare squared distances in 64-bit). That relation is one-way, so build a directed graph and run a DFS from every bomb, keeping the largest reach.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'dfs', 'bfs', 'geometry', 'leetcode'],
    'related_session' => 'detonate-the-maximum-bombs',
];
