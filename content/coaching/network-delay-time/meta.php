<?php
declare(strict_types=1);

return [
    'title' => 'Network Delay Time: slowest shortest path',
    'leetcode' => 743,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: Dijkstra from k with a min-heap, skip stale entries, then return the largest distance or -1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'network-delay-time',
    'tags' => ['graphs', 'shortest-path', 'dijkstra', 'heap', 'step-by-step'],
];
