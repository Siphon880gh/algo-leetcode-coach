<?php
declare(strict_types=1);

return [
    'title' => 'Rank Transform of a Matrix: value groups with DSU',
    'leetcode' => 1632,
    'difficulty' => 'Hard',
    'summary' => 'Process values ascending. Cells with the same value in a shared row or column must share a rank, so union them (rows and columns as DSU nodes). Each group gets 1 + the max current rank among its rows and columns.',
    'category' => 'LeetCode',
    'subcategory' => 'Union Find',
    'topic' => 'LeetCode · Union Find',
    'kind' => 'algo',
    'tags' => ['union-find', 'sorting', 'matrix', 'leetcode'],
    'related_session' => 'rank-transform-of-a-matrix',
];
