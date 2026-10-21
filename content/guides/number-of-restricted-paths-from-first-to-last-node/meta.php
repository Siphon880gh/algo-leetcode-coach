<?php
declare(strict_types=1);

return [
    'title' => 'Number of Restricted Paths From First to Last Node: Dijkstra then DP',
    'leetcode' => 1786,
    'difficulty' => 'Med',
    'summary' => 'Run Dijkstra from node n to get dist. A restricted path always moves to a node with smaller dist, so the graph is a DAG; count paths with DP in increasing dist order, adding ways from neighbours with smaller dist.',
    'category' => 'LeetCode',
    'subcategory' => 'Shortest Path',
    'topic' => 'LeetCode · Shortest Path',
    'kind' => 'algo',
    'tags' => ['shortest-path', 'dynamic-programming', 'graph', 'leetcode'],
    'related_session' => 'number-of-restricted-paths-from-first-to-last-node',
];
