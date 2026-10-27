<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Time to Transport All Individuals',
    'leetcode' => 3594,
    'difficulty' => 'Hard',
    'summary' => 'Dijkstra over states (who is still at camp, current stage). A trip sends a group of up to k (time = slowest times mul[stage]) and, if anyone is left, one person rows back. Each crossing advances the stage by floor(duration) mod m.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-time-to-transport-all-individuals',
    'related_session' => 'minimum-time-to-transport-all-individuals',
];
