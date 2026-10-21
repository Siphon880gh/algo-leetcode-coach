<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse II: retrograde game solving',
    'leetcode' => 1728,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: states are (mouse, cat, turn); seed known results (cat on mouse or food → cat wins; mouse on food → mouse wins) and propagate backwards, using out-degree counts for forced losses. Unresolved states are cat wins. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Game Theory',
    'topic' => 'LeetCode · Game Theory',
    'related_guide' => 'cat-and-mouse-ii',
    'tags' => ['game-theory', 'memoization', 'graph', 'step-by-step'],
];
