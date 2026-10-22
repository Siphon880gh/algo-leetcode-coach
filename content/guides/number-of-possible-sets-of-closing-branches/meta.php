<?php
declare(strict_types=1);

return [
    'title' => 'Number of Possible Sets of Closing Branches: try every subset',
    'leetcode' => 2959,
    'difficulty' => 'Hard',
    'summary' => 'n ≤ 10, so try all 2^n sets of kept branches. Run Floyd–Warshall using only roads and middle points among kept branches, and count sets where every kept pair is within maxDistance.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'kind' => 'algo',
    'tags' => ['bit-manipulation', 'graph', 'enumeration', 'shortest-path', 'heap', 'leetcode'],
    'related_session' => 'number-of-possible-sets-of-closing-branches',
];
