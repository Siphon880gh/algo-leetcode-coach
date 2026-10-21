<?php
declare(strict_types=1);

return [
    'title' => 'Shortest Bridge: BFS from a whole island',
    'leetcode' => 934,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: mark one island and enqueue all its cells, then BFS across water; the level at which you touch the other island is the answer. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'shortest-bridge',
    'tags' => ['bfs', 'depth-first-search', 'matrix', 'step-by-step'],
];
