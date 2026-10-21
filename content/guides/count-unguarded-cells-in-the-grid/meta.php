<?php
declare(strict_types=1);

return [
    'title' => 'Count Unguarded Cells in the Grid: sweep rows and columns',
    'leetcode' => 2257,
    'difficulty' => 'Med',
    'summary' => 'Mark guards and walls. Sweep each row left-to-right and right-to-left, and each column both ways, carrying whether a guard is visible; a wall or guard resets the state. Count empty cells never seen.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'matrix', 'simulation', 'leetcode'],
    'related_session' => 'count-unguarded-cells-in-the-grid',
];
