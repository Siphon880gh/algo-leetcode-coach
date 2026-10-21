<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse II: memoised game search with a turn cap',
    'leetcode' => 1728,
    'difficulty' => 'Hard',
    'summary' => 'State = (turn, mouse cell, cat cell). Mouse wins if some move reaches food or leads to a winning state; cat wins if it reaches food or the mouse, or every reply leaves the mouse losing. Cap turns well below 1000, since a winning mouse never needs that long.',
    'category' => 'LeetCode',
    'subcategory' => 'Game Theory',
    'topic' => 'LeetCode · Game Theory',
    'kind' => 'algo',
    'tags' => ['game-theory', 'memoization', 'graph', 'leetcode'],
    'related_session' => 'cat-and-mouse-ii',
];
