<?php
declare(strict_types=1);

return [
    'title' => 'Modify Graph Edge Weights: Dijkstra, then fix one edge at a time',
    'leetcode' => 2699,
    'difficulty' => 'Hard',
    'summary' => 'Ignore the -1 edges: if the path is already shorter than target, it is impossible. Otherwise turn the -1 edges on one at a time at weight 1, rerunning Dijkstra; when the distance drops to target or below, raise that edge by the gap and set the rest to the maximum.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'modify-graph-edge-weights',
];
