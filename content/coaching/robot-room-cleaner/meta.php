<?php
declare(strict_types=1);

return [
    'title' => 'Robot Room Cleaner: DFS by relative coordinates, back up after each branch',
    'leetcode' => 489,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: clean an unknown room with move, turnRight, turnLeft, clean. Use relative coordinates with start (0, 0) facing up. DFS: clean, try 4 directions turning right each time, recurse into unvisited cells that move() accepts, then come back with turn 180°, move, turn 180°. Not 490. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'dfs', 'interactive', 'step-by-step'],
    'related_guide' => 'robot-room-cleaner',
];
