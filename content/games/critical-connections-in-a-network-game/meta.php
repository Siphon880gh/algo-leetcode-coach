<?php
declare(strict_types=1);

return [
    'title' => 'Critical Connections (Tarjan bridges)',
    'leetcode' => 1192,
    'difficulty' => 'Hard',
    'summary' => 'DFS assigning discovery times; low[u] = earliest time reachable from u\'s subtree with one back edge. Edge u–v (v a child) is a bridge iff low[v] > disc[u].',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'critical-connections-in-a-network',
    'related_session' => 'critical-connections-in-a-network',
];
