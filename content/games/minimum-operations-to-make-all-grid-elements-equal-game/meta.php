<?php
declare(strict_types=1);

return [
    'title' => 'Minimum Operations to Make All Grid Elements Equal',
    'leetcode' => 3888,
    'difficulty' => 'Hard',
    'summary' => 'Fix a target value t at least max. Scan cells top-left to bottom-right with a 2D difference array: the remaining need at (i, j) must be applied by k by k squares whose top-left is (i, j), which only exist when the square fits. Any negative need or leftover need breaks t. The smallest workable t gives the fewest operations.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'tags' => ['grid', 'mini-game', 'leetcode'],
    'entry' => 'index.html',
    'related_guide' => 'minimum-operations-to-make-all-grid-elements-equal',
    'related_session' => 'minimum-operations-to-make-all-grid-elements-equal',
];
