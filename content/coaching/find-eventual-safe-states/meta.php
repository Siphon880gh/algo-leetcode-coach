<?php
declare(strict_types=1);

return [
    'title' => 'Find Eventual Safe States: peel from the terminals',
    'leetcode' => 802,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: reverse the edges, start from out-degree-0 nodes, and mark a node safe once all its edges lead to safe nodes. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'find-eventual-safe-states',
    'tags' => ['graphs', 'topological-sort', 'dfs', 'step-by-step'],
];
