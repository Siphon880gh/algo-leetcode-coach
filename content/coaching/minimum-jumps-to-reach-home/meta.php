<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Jumps Home: BFS with direction state',
    'leetcode' => 1654,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: BFS over (position, last move backward); forward always, backward only after a forward; skip forbidden; cap positions. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Breadth-First Search',
    'topic' => 'LeetCode · Breadth-First Search',
    'related_guide' => 'minimum-jumps-to-reach-home',
    'tags' => ['breadth-first-search', 'graph', 'step-by-step'],
];
