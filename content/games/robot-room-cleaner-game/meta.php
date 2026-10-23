<?php
declare(strict_types=1);

return [
    'title' => 'Robot Room Cleaner',
    'leetcode' => 489,
    'difficulty' => 'Hard',
    'summary' => 'DFS with relative coordinates and a visited set: at each cell clean, then try the 4 directions (turning right each time); after exploring a neighbor, back up (turn 180°, move, turn 180°). Every reachable open cell gets cleaned.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'tags' => ['backtracking', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'robot-room-cleaner',
    'related_session' => 'robot-room-cleaner',
];
