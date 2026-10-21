<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse: solve backward from known outcomes',
    'leetcode' => 913,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: states are (mouse, cat, turn); start from the known wins and propagate backward, resolving a state when a winning move exists or every move loses. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'cat-and-mouse',
    'tags' => ['graphs', 'game-theory', 'topological-sort', 'bfs', 'step-by-step'],
];
