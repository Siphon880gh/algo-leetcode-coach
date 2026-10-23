<?php
declare(strict_types=1);

return [
    'title' => 'Find X Value of Array II: segment tree of prefix remainder counts',
    'leetcode' => 3525,
    'difficulty' => 'Hard',
    'summary' => 'Each node stores its product mod k and, for each r, how many of its prefixes have product ≡ r. Joining left and right: right’s counts are shifted by left’s product. Point updates and a suffix query from start answer each query.',
    'category' => 'LeetCode',
    'subcategory' => 'Segment Tree',
    'topic' => 'LeetCode · Segment Tree',
    'kind' => 'algo',
    'tags' => ['segment-tree', 'array', 'math', 'leetcode'],
    'related_session' => 'find-x-value-of-array-ii',
];
