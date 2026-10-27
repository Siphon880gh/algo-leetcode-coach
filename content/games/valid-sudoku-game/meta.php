<?php
declare(strict_types=1);

return [
    'title' => 'Valid Sudoku',
    'leetcode' => 36,
    'difficulty' => 'Med',
    'summary' => 'One pass over the filled cells with three sets of seen digits: per row, per column, and per 3 by 3 box (index (r divided by 3, rounded down) times 3 + (c divided by 3, rounded down)). A repeat anywhere: invalid.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'valid-sudoku',
    'related_session' => 'valid-sudoku',
];
