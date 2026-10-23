<?php
declare(strict_types=1);

return [
    'title' => 'Create Grid With Exactly K Paths I: free blocks, then a corridor',
    'leetcode' => 3988,
    'difficulty' => 'Med',
    'summary' => 'A free a × b block in the top-left corner has C(a + b − 2, a − 1) paths, and blocks chained corner to corner multiply. With k ≤ 4 the useful pieces are 2 × 2 (2), 2 × 3 or 3 × 2 (3), 2 × 4 or 4 × 2 (4), and two 2 × 2 blocks in a row (4). Finish with a corridor along the row and then down the last column.',
    'category' => 'LeetCode',
    'subcategory' => 'Matrix',
    'topic' => 'LeetCode · Matrix',
    'kind' => 'algo',
    'tags' => ['array', 'math', 'combinatorics', 'matrix', 'leetcode'],
    'related_session' => 'create-grid-with-exactly-k-paths-i',
];
