<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Cost Path with At Most K Turns',
    'leetcode' => 4046,
    'difficulty' => 'Hard',
    'summary' => 'Run Dijkstra on states (cell, last direction, turns used). A move in a new direction uses a turn, and states past k turns are dropped. The answer is the cheapest state at the target.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-cost-path-with-at-most-k-turns',
    'related_session' => 'minimum-cost-path-with-at-most-k-turns',
];
