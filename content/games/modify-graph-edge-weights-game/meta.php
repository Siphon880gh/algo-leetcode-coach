<?php
declare(strict_types=1);

return [
    'title' => 'Modify Graph Edge Weights',
    'leetcode' => 2699,
    'difficulty' => 'Hard',
    'summary' => 'Treat every −1 edge as huge. If the shortest path is already < target: impossible. Then switch −1 edges to weight 1 one at a time; when the distance first drops to at most target, raise that edge by the gap so it is exactly target.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'modify-graph-edge-weights',
    'related_session' => 'modify-graph-edge-weights',
];
