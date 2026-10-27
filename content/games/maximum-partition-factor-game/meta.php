<?php
declare(strict_types=1);

return [
    'title' => 'Maximum Partition Factor',
    'leetcode' => 3710,
    'difficulty' => 'Hard',
    'summary' => 'Binary search the answer d: a split with factor at least d exists exactly when the graph joining pairs closer than d is bipartite (2-color it with BFS). The answer is the largest such d, which is always one of the pair distances.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'maximum-partition-factor',
    'related_session' => 'maximum-partition-factor',
];
