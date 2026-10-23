<?php
declare(strict_types=1);

return [
    'title' => 'Find Eventual Safe States',
    'leetcode' => 802,
    'difficulty' => 'Med',
    'summary' => 'Reverse the edges and run Kahn from terminal nodes (out-degree 0). A node becomes safe when all of its outgoing edges lead to safe nodes. Return safe nodes sorted.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'find-eventual-safe-states',
    'related_session' => 'find-eventual-safe-states',
];
