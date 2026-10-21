<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves with Rotations: BFS over (r, c, orientation)',
    'leetcode' => 1210,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: model the snake by its tail and orientation, generate right, down, and rotation moves with their cell checks, and BFS to the horizontal target. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'minimum-moves-to-reach-target-with-rotations',
    'tags' => ['bfs', 'graphs', 'matrix', 'step-by-step'],
];
