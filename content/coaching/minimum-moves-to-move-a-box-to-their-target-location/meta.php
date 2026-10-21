<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Moves to Move a Box to Their Target Location: BFS over pushes',
    'leetcode' => 1263,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: BFS over (box, player-side) states counting pushes, and allow a push only if the player can walk to the cell behind the box without passing through it. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graph',
    'topic' => 'LeetCode · Graph',
    'related_guide' => 'minimum-moves-to-move-a-box-to-their-target-location',
    'tags' => ['bfs', 'graphs', 'matrix', 'step-by-step'],
];
