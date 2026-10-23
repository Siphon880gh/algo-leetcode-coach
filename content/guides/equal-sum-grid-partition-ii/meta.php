<?php
declare(strict_types=1);

return [
    'title' => 'Equal Sum Grid Partition II: cuts with one removable cell',
    'leetcode' => 3548,
    'difficulty' => 'Hard',
    'summary' => 'Sweep cuts as in part I, keeping value counts for each side. If the sides differ by d, the larger side needs a cell worth d whose removal keeps it connected: any cell when the side is at least 2 × 2, only the two end cells when it is a single row or column.',
    'category' => 'LeetCode',
    'subcategory' => 'Prefix Sum',
    'topic' => 'LeetCode · Prefix Sum',
    'kind' => 'algo',
    'tags' => ['array', 'hash-table', 'enumeration', 'matrix', 'prefix-sum', 'leetcode'],
    'related_session' => 'equal-sum-grid-partition-ii',
];
