<?php
declare(strict_types=1);

return [
    'title' => 'Critical Connections in a Network: low-link',
    'leetcode' => 1192,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: DFS with discovery times, compute low-links through back edges, and report tree edges with low[v] > disc[u]. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'critical-connections-in-a-network',
    'tags' => ['graphs', 'dfs', 'tarjan', 'step-by-step'],
];
