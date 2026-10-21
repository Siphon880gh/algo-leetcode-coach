<?php
declare(strict_types=1);

return [
    'title' => 'Race Car: BFS on (position, speed) with bounds',
    'leetcode' => 818,
    'difficulty' => 'Hard',
    'summary' => 'Each state is a position and a speed; A doubles the speed after moving, and R resets it to ±1. BFS gives the shortest instruction count. Prune positions outside about [−target, 2 · target] and skip a reverse unless the car is heading away from the target.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'bfs', 'dynamic-programming', 'leetcode'],
    'related_session' => 'race-car',
];
