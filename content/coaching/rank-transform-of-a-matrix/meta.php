<?php
declare(strict_types=1);

return [
    'title' => 'Rank Transform of a Matrix: equal values via DSU',
    'leetcode' => 1632,
    'difficulty' => 'Hard',
    'summary' => 'Walk a deterministic path: process values ascending; union equal cells that share a row or column; each group takes 1 + the max rank so far in its rows and columns. Wrong turns tell you when to step back.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'related_guide' => 'rank-transform-of-a-matrix',
    'tags' => ['union-find', 'sorting', 'matrix', 'step-by-step'],
];
