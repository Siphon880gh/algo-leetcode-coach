<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse: solve the game backward from known outcomes',
    'leetcode' => 913,
    'difficulty' => 'Hard',
    'summary' => 'States are (mouse, cat, whose turn). Start from the known results (mouse in the hole, cat on the mouse) and propagate backward: a state wins if some move reaches a win for the mover, and loses once every move leads to a loss. Unresolved states are draws.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['graphs', 'game-theory', 'topological-sort', 'bfs', 'leetcode'],
    'related_session' => 'cat-and-mouse',
];
