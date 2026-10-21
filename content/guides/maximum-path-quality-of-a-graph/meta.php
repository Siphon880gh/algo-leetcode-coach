<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Path Quality of a Graph: bounded backtracking',
    'leetcode' => 2065,
    'difficulty' => 'Hard',
    'summary' => 'Edges take at least 10 seconds and maxTime is at most 100, so a path has at most 10 edges; with degree ≤ 4 a DFS that revisits nodes freely is small. Track visit counts so each node\'s value is added once, and record the quality whenever the walk is back at 0.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'graph', 'dfs', 'leetcode'],
    'related_session' => 'maximum-path-quality-of-a-graph',
];
