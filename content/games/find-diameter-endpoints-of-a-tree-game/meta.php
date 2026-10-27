<?php
declare(strict_types=1);

return [
    'title' => 'Find Diameter Endpoints of a Tree',
    'leetcode' => 3787,
    'difficulty' => 'Med',
    'summary' => 'BFS from any node to a farthest node a, then BFS from a to a farthest node b; D = dist(a, b). A node is an endpoint of some diameter exactly when its distance to a or to b equals D.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'tags' => ['tree', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-diameter-endpoints-of-a-tree',
    'related_session' => 'find-diameter-endpoints-of-a-tree',
];
