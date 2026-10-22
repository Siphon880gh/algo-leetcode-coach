<?php
declare(strict_types=1);

return [
    'title' => 'Number of Possible Sets of Closing Branches: kept-only paths',
    'leetcode' => 2959,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: for each subset, run Floyd–Warshall through kept branches only. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Graphs',
    'topic' => 'LeetCode · Graphs',
    'related_guide' => 'number-of-possible-sets-of-closing-branches',
    'tags' => ['bit-manipulation', 'graph', 'enumeration', 'shortest-path', 'heap', 'step-by-step'],
];
