<?php
declare(strict_types=1);

return [
    'title' => 'Block Placement Queries: max gap in a segment tree',
    'leetcode' => 3161,
    'difficulty' => 'Hard',
    'summary' => 'Keep obstacles sorted and store, at each obstacle, the gap back to the previous one in a max segment tree. A block of size sz fits in [0, x] if some gap up to x, or the stretch from the last obstacle to x, is at least sz.',
    'category' => 'LeetCode',
    'subcategory' => 'Binary Search',
    'topic' => 'LeetCode · Binary Search',
    'kind' => 'algo',
    'tags' => ['binary-indexed-tree', 'segment-tree', 'array', 'binary-search', 'ordered-set', 'leetcode'],
    'related_session' => 'block-placement-queries',
];
