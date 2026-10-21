<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Move a Box to Their Target Location: 0-1 BFS on (box, player)',
    'leetcode' => 1263,
    'difficulty' => 'Hard',
    'summary' => 'The state is the box cell plus the player cell. A walk costs 0 pushes and a push costs 1, so a 0-1 BFS (deque) over states finds the fewest pushes; walls block both the player and the box.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'kind' => 'algo',
    'tags' => ['bfs', 'graphs', 'matrix', 'leetcode'],
    'related_session' => 'minimum-moves-to-move-a-box-to-their-target-location',
];
