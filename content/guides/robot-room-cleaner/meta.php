<?php
declare(strict_types=1);

return [
    'title' => 'Robot Room Cleaner: DFS by relative coordinates, back up after each branch',
    'leetcode' => 489,
    'difficulty' => 'Hard',
    'summary' => 'Clean every reachable cell using only move(), turnLeft(), turnRight(), clean(); the map and start are unknown. Treat the start as (0, 0) facing up. DFS: clean, then for each of 4 directions (turning right each time), if the next cell is unvisited and move() succeeds, recurse and then go back (turn 180°, move, turn 180°). Not 490.',
    'category' => 'LeetCode',
    'subcategory' => 'Backtracking',
    'topic' => 'LeetCode · Backtracking',
    'kind' => 'algo',
    'tags' => ['backtracking', 'dfs', 'interactive', 'leetcode'],
    'related_session' => 'robot-room-cleaner',
];
