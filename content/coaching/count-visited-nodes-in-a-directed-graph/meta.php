<?php
declare(strict_types=1);

return [
    'title' => 'Count Visited Nodes in a Directed Graph: share results, tails add 1',
    'leetcode' => 2876,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: walk once per node overall; cycle nodes get the cycle length, tail nodes one more than their successor. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'count-visited-nodes-in-a-directed-graph',
    'tags' => ['dynamic-programming', 'graph', 'memoization', 'step-by-step'],
];
