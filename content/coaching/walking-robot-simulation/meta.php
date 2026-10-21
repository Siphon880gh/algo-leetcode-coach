<?php
declare(strict_types=1);

return [
    'title' => 'Walking Robot Simulation: one square at a time',
    'leetcode' => 874,
    'difficulty' => 'Med',
    'summary' => 'Walk a deterministic path: keep a direction index, turn with ±1 mod 4, step one square at a time against an obstacle set, and track the largest x² + y² seen. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'related_guide' => 'walking-robot-simulation',
    'tags' => ['simulation', 'hash-table', 'arrays', 'step-by-step'],
];
