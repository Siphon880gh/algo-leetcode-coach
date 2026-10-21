<?php
declare(strict_types=1);

return [
    'title' => 'Walking Robot Simulation: step one square at a time',
    'leetcode' => 874,
    'difficulty' => 'Med',
    'summary' => 'Keep a direction index into (N, E, S, W), turn with ±1 mod 4, and move one square at a time so obstacles in a hash set stop the robot. Track the largest x² + y² ever reached.',
    'category' => 'LeetCode',
    'subcategory' => 'Simulation',
    'topic' => 'LeetCode · Simulation',
    'kind' => 'algo',
    'tags' => ['simulation', 'hash-table', 'arrays', 'leetcode'],
    'related_session' => 'walking-robot-simulation',
];
