<?php
declare(strict_types=1);

return [
    'title' => 'Where Will the Ball Fall: follow each board',
    'leetcode' => 1706,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: at each row, a ball in column c moves to c + grid[r][c]; it gets stuck at a wall or when the neighbour board points the other way. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'where-will-the-ball-fall',
    'tags' => ['simulation', 'matrix', 'step-by-step'],
];
