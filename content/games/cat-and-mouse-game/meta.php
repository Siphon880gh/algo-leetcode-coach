<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse (retrograde analysis)',
    'leetcode' => 913,
    'difficulty' => 'Hard',
    'summary' => 'States (mouse, cat, whose turn). Known results: mouse at 0 wins, cat on mouse wins. Work backward: a parent is a win if one move reaches its win; it is a loss when all moves reach losses (degree counting). Unresolved states are draws.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'cat-and-mouse',
    'related_session' => 'cat-and-mouse',
];
