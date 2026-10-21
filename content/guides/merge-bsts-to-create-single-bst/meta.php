<?php
declare(strict_types=1);

return [
    'title' => 'Merge BSTs to Create Single BST: find the root, attach, validate',
    'leetcode' => 1932,
    'difficulty' => 'Hard',
    'summary' => 'The final root must be the only root value that is not a leaf of another tree. Map root values to trees; DFS from the final root with (lo, hi) bounds, attaching a tree whenever a leaf matches a root. Fail on a bound violation or if any tree is left unused.',
    'category' => 'LeetCode',
    'subcategory' => 'Tree',
    'topic' => 'LeetCode · Tree',
    'kind' => 'algo',
    'tags' => ['tree', 'binary-search-tree', 'hash-table', 'dfs', 'leetcode'],
    'related_session' => 'merge-bsts-to-create-single-bst',
];
