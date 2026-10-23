<?php
declare(strict_types=1);

return [
    'title' => 'Cat and Mouse II (retrograde analysis)',
    'leetcode' => 1728,
    'difficulty' => 'Hard',
    'summary' => 'States (mouse cell, cat cell, turn). Terminal: cat on mouse or cat on food → cat wins; mouse on food → mouse wins. Propagate backward with move counts; anything unresolved (endless play) counts as a cat win.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['graph', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'cat-and-mouse-ii',
    'related_session' => 'cat-and-mouse-ii',
];
