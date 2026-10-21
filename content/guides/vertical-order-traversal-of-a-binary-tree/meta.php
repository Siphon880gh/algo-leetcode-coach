<?php
declare(strict_types=1);

return [
    'title' => 'Vertical Order Traversal of a Binary Tree: sort by (column, row, value)',
    'leetcode' => 987,
    'difficulty' => 'Hard',
    'summary' => 'Record every node as (column, row, value), with the root at (0, 0), left child at column − 1 and right child at column + 1. Sort the triples, then group the values by column.',
    'category' => 'LeetCode',
    'subcategory' => 'Trees',
    'topic' => 'LeetCode · Trees',
    'kind' => 'algo',
    'tags' => ['trees', 'sorting', 'depth-first-search', 'hash-table', 'leetcode'],
    'related_session' => 'vertical-order-traversal-of-a-binary-tree',
];
