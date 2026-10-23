<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Distance Excluding One Maximum Weighted Edge: one free edge',
    'leetcode' => 3778,
    'difficulty' => 'Med',
    'summary' => 'Dropping the heaviest edge of a path is the same as dropping the best single edge, since minimizing picks the heaviest anyway. So run Dijkstra on (node, free edge used?).',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graph', 'shortest-path', 'leetcode'],
    'related_session' => 'minimum-distance-excluding-one-maximum-weighted-edge',
];
