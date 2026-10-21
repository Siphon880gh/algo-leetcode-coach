<?php
declare(strict_types=1);

return [
    'title' => 'The Time When the Network Becomes Idle: per-server formula',
    'leetcode' => 2039,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: BFS distances, round trip t = 2d, last resend ((t − 1) // p) · p, idle at last + t + 1. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'the-time-when-the-network-becomes-idle',
    'tags' => ['graph', 'bfs', 'math', 'step-by-step'],
];
