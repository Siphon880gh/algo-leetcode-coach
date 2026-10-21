<?php
declare(strict_types=1);

return [
    'title' => 'Find Closest Node to Given Two Nodes: two walks, then compare',
    'leetcode' => 2359,
    'difficulty' => 'Med',
    'summary' => 'Each node has at most one outgoing edge, so walking from a node visits each reachable node once. Record distances from node1 and node2 (stopping at −1 or a repeat), then pick the node reached by both with the smallest larger distance, lowest index on ties.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['depth-first-search', 'graph', 'leetcode'],
    'related_session' => 'find-closest-node-to-given-two-nodes',
];
